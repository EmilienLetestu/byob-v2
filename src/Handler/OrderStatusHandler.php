<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 19/08/2018
 * Time: 09:55
 */

namespace App\Handler;



use App\Entity\Orders;
use App\Handler\Interfaces\OrderHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

class OrderStatusHandler implements OrderHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * OrderStatusHandler constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function  __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param FormInterface $form
     * @param Orders $order
     * @return bool
     */
    public function handle(FormInterface $form, Orders $order): bool
    {
       if($form->isSubmitted() && $form->isValid())
       {
           $order->setStatus($form->get('status')->getData());

           $this->doctrine->flush();

           return true;
       }

       return false;
    }

}