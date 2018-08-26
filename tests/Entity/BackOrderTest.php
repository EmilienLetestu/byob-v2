<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 26/08/2018
 * Time: 16:32
 */

namespace App\Tests\Entity;


use App\Entity\BackOrder;
use PHPUnit\Framework\TestCase;

class BackOrderTest extends TestCase
{
    public function testBackOrder()
    {
        $backOrder = new BackOrder();

        $backOrder->setRegularize(false);
        $backOrder->setSince('Y-m-d');
        $backOrder->setDelivered(false);


        self::assertInternalType(
            'bool', $backOrder->getRegularize()
        );
        self::assertFalse(
            $backOrder->getRegularize()
        );
        self::assertNull(
            $backOrder->getRegularizedOn()
        );
        self::assertEquals(
            new \DateTime(date('Y-m-d')), $backOrder->getSince()
        );
        self::assertFalse(
            $backOrder->getDelivered()
        );
        self::assertNull(
            $backOrder->getDeliveredOn()
        );

    }
}