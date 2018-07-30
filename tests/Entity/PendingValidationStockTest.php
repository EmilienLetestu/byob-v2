<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 10:52
 */

namespace App\Tests\Entity;
use App\Entity\PendingValidationStock;
use PHPUnit\Framework\TestCase;

/**
 * Class PendingValidationStockTest
 * @package App\Tests\Entity
 */
class PendingValidationStockTest extends TestCase
{
    public function testPendingValidationStock()
    {

        $today = new \DateTime(date('Y-m-d'));

        $pending = new PendingValidationStock();

        $pending->setQuantity(54);
        $pending->setProcessed(false);
        $pending->setAskedOn('Y-m-d');

        $this->assertEquals(54, $pending->getQuantity());
        $this->assertInternalType('int', $pending->getQuantity());
        $this->assertEquals(false, $pending->getProcessed());
        $this->assertEquals($today, $pending->getAskedOn());
        $this->assertEquals(false, $pending->getValidated());
        $this->assertNull($pending->getProcessedOn());



    }
}