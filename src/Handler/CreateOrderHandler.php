<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 11:24
 */

namespace App\Handler;


use App\Entity\Orders;
use App\Handler\Interfaces\EntityFormHandlerInterface;
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
     * @var SessionInterface
     */
    private $session;

    /**
     * @var Orders
     */
    private $order;

    /**
     * CreateOrderHandler constructor.
     * @param TokenStorageInterface $tokenStorage
     * @param SessionInterface $session
     */
    public function __construct(
        TokenStorageInterface $tokenStorage,
        SessionInterface      $session
    )
    {
        $this->tokenStorage = $tokenStorage;
        $this->session      = $session;
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

            $this->session->set('order', $this->order);

            return true;
        }

        return false;
    }
}