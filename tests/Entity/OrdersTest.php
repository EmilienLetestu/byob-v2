<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 09:56
 */

namespace App\Tests\Entity;


use App\Entity\Orders;
use PHPUnit\Framework\TestCase;

/**
 * Class OrdersTest
 * @package App\Tests\Entity
 */
class OrdersTest extends TestCase
{
    public function testsOrders()
    {
        $today = new \DateTime(date('Y-m-d'));

        $order = new Orders();

        $order->setReference('cmd_');
        $order->setOrderedOn('Y-m-d');
        $order->setStatus('En attente de livraison');

        $this->assertInternalType('string', $order->getReference());
        $this->assertContains('cmd_', $order->getReference());
        $this->assertEquals($today, $order->getOrderedOn());
        $this->assertEquals('En attente de livraison', $order->getStatus());
    }
}