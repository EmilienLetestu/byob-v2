<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 28/08/2018
 * Time: 20:22
 */

namespace App\Services;


use App\Entity\Orders;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PrepareForDelivery
{
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * PrepareForDelivery constructor.
     * @param SessionInterface $session
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(
        SessionInterface  $session,
        EntityManagerInterface $doctrine
    )
    {
        $this->session  = $session;
        $this->doctrine = $doctrine;
    }

    /**
     * @param int $orderId
     */
    public function regularOrderReady(int $orderId): void
    {
        $order = $this->doctrine->getRepository(Orders::class)
            ->findOrderWithId($orderId)
        ;

        $order->setStatus('en attente d\'enlèvement');

        $this->doctrine->flush();
    }


    public function backOrderReady(): void
    {
        $backOrders = $this->session->get('backOrders');

        foreach ($backOrders as $inOrder)
        {
            $backOrder = $this->doctrine->merge($inOrder->getBackOrder());
            $backOrder->setPrepared(true);
            $backOrder->setPreparedOn('Y-m-d');

        }
        $this->doctrine->flush();
        $this->session->remove('backOrders');
    }
}