<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 11:01
 */

namespace App\Tests\Entity;


use App\Entity\InStockProduct;
use PHPUnit\Framework\TestCase;

/**
 * Class InStockProductTest
 * @package App\Tests\Entity
 */
class InStockProductTest extends TestCase
{
    public function testInStockProduct()
    {
        $inStockProduct = new InStockProduct();

        $inStockProduct->setLevel(2500);
        $inStockProduct->setAlertLevel(150);

        $this->assertEquals(2500, $inStockProduct->getLevel());
        $this->assertInternalType('int', $inStockProduct->getLevel());
        $this->assertEquals(150, $inStockProduct->getAlertLevel());
        $this->assertInternalType('int', $inStockProduct->getAlertLevel());

    }
}