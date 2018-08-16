<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 11:24
 */

namespace App\Handler;


use App\Entity\InOrderProduct;
use App\Entity\Orders;
use App\Handler\Interfaces\EntityFormHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CreateOrderHandler implements EntityFormHandlerInterface
{

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var
     */
    private $doctrine;

    /**
     * @var Orders
     */
    private $order;

    /**
     * CreateOrderHandler constructor.
     * @param TokenStorageInterface $tokenStorage
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(
        TokenStorageInterface  $tokenStorage,
        EntityManagerInterface $doctrine
    )
    {
        $this->tokenStorage = $tokenStorage;
        $this->doctrine     = $doctrine;
        $this->order        = new Orders();
    }


    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid())
        {
            $this->order->setReference('cmd_');
            $this->order->setOrderedOn('Y-m-d');
            $this->order->setStatus('En attente de validation');
            $this->order->setOrderedFor(
                $form->get('customer')->getData()
            );
            $this->order->setOrderedBy(
                $this->tokenStorage->getToken()->getUser()
            );

            $this->doctrine->persist($this->order);

            foreach($form->get('inOrderProducts') as $dto)
            {
                $inOrder = new InOrderProduct();

                $inOrder->setProduct(
                    $dto->get('product')->getData()->getProduct()
                );

                $inOrder->setQuantity(
                    $dto->get('quantity')->getData()
                );

                $inOrder->setOrder($this->order);

                $this->doctrine->persist($inOrder);
            }

            $this->doctrine->flush();

            return true;
        }

        return false;
    }
}