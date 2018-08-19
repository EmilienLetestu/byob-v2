<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 17/08/2018
 * Time: 10:35
 */

namespace App\Handler;


use App\Entity\PendingValidationStock;
use App\Handler\Interfaces\FormHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ArrivalCollectionHandler implements FormHandlerInterface
{

    /**
     * @var EntityManagerInterface
     */
    private  $doctrine;

    /**
     * @var TokenStorageInterface
     */
    private  $tokenStorage;

    public function __construct(
        EntityManagerInterface $doctrine,
        TokenStorageInterface  $tokenStorage
    )
    {
        $this->doctrine     = $doctrine;
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
           $user = $this->tokenStorage->getToken()->getUser();
           $warehouse = $form->get('warehouse')->getData()->getWarehouse();

           foreach ($form->get('arrivals') as $arrival)
           {
               $pending = new PendingValidationStock();

               $pending->setQuantity($arrival->get('quantity')->getData());
               $pending->setProduct($arrival->get('product')->getData());
               $pending->setAskedOn('Y-m-d');
               $pending->setWarehouse($warehouse);
               $pending->setAskedBy($user);

               $this->doctrine->persist($pending);
           }

           $this->doctrine->flush();

           return true;
       }

       return false;
    }
}