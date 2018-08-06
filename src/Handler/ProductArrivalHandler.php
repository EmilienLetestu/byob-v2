<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 14:04
 */

namespace App\Handler;

use App\Entity\PendingValidationStock;
use App\Entity\Product;

use App\Handler\Interfaces\ProductArrivalHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ProductArrivalHandler implements ProductArrivalHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * @var Product
     */
    private $pendingValidation;

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
        $this->pendingValidation      = new PendingValidationStock();
        $this->tokenStorage = $tokenStorage;
    }

    public function handle(FormInterface $form, Product $product): bool
    {
        if($form->isSubmitted() && $form->isValid())
        {
            $user = $this->tokenStorage->getToken()->getUser();

            $this->pendingValidation->setProduct($product);
            $this->pendingValidation->setAskedBy($user);
            $this->pendingValidation->setQuantity($form->get('quantity')->getData());
            $this->pendingValidation->setWarehouse(
                $form->get('warehouse')->getData()->getWarehouse()
            );
            $this->pendingValidation->setAskedOn('Y-m-d');

            $this->doctrine->persist($this->pendingValidation);
            $this->doctrine->flush();

            return true;

        }

        return false;
    }


}