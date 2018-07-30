<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 10:59
 */

namespace App\Tests\Entity;


use App\Entity\StockValidation;
use PHPUnit\Framework\TestCase;

/**
 * Class StockValidationTest
 * @package App\Tests\Entity
 */
class StockValidationTest extends TestCase
{
    public function testStockValidation()
    {
        $today = new \DateTime(date('Y-m-d'));

        $stockValidation = new StockValidation();

        $stockValidation->setProcessedOn('Y-m-d');

        $this->assertEquals($today, $stockValidation->getProcessedOn());
    }
}