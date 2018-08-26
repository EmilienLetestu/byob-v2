<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 26/08/2018
 * Time: 16:32
 */

namespace App\Tests\Entity;


use App\Entity\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    public function testCustomer()
    {
        $customer = new Customer();

        $customer->setCompany('sarl test');
        $customer->setAddress('01 rue du test 000010 TestCity');
        $customer->setAddedOn('Y-m-d');

        self::assertSame(
            'sarl test', $customer->getCompany()
        );
        self::assertSame(
            '01 rue du test 000010 TestCity', $customer->getAddress()
        );
        self::assertEquals(
            new \DateTime(date('Y-m-d')), $customer->getAddedOn()
        );
    }
}