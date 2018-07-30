<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 10:46
 */

namespace App\Tests\Entity;


use App\Entity\InOrderProduct;
use PHPUnit\Framework\TestCase;

/**
 * Class InOrderProductTest
 * @package App\Tests\Entity
 */
class InOrderProductTest extends TestCase
{
    public function testInOrderProduct()
    {
        $inOrderProduct = new InOrderProduct();

        $inOrderProduct->setQuantity(250);

        $this->assertEquals(250, $inOrderProduct->getQuantity());
        $this->assertInternalType('int', $inOrderProduct->getQuantity());
    }
}