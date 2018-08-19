<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 22:03
 */

namespace App\Handler;


use App\Entity\Product;
use App\Handler\Interfaces\FormHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class ProductFormHandler implements FormHandlerInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * ProductFormHandler constructor.
     * @param EntityManagerInterface $doctrine
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        TokenStorageInterface  $tokenStorage
    )
    {
        $this->doctrine     = $doctrine;
        $this->product      = new Product();
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid())
        {
            $this->product->setModel(
                $form->get('model')->getData()
            );
            $this->product->setFamily(
                $form->get('family')->getData()
            );
            $this->product->setCategory(
                $form->get('category')->getData()
            );
            $this->product->setType(
                $form->get('type')->getData()
            );
            $this->product->setMake(
                $form->get('make')->getData()
            );
            $this->product->setDesignation(
                $form->get('designation')->getData()
            );
            $this->product->setReference('prod_');
            $this->product->setReferencedOn('Y-m-d');

            $this->product->setReferencedBy(
                $this->tokenStorage->getToken()->getUser()
            );

            $this->doctrine->persist($this->product);
            $this->doctrine->flush();

            return true;
        }

        return false;
    }

}