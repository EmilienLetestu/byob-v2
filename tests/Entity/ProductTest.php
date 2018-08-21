<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 10:03
 */

namespace App\Tests\Entity;


use App\Entity\Product;
use PHPUnit\Framework\TestCase;

/**
 * Class ProductTest
 * @package App\Tests\Entity
 */
class ProductTest extends TestCase
{
    public function testProduct()
    {

        $today = new \DateTime(date('Y-m-d'));

        $product = new Product();

        $product->setModel('coca-cola light');
        $product->setReference('787787487');
        $product->setReferencedOn('Y-m-d');

        $this->assertEquals('coca-cola light', $product->getModel());
        $this->assertContains('787787487', $product->getReference());
        $this->assertEquals($today, $product->getReferencedOn());
        $this->assertNull($product->getLastModification());
        $this->assertNull($product->getPrice());

        $product->setPrice(7.50);

        $this->assertInternalType('float', $product->getPrice());
        $this->assertEquals(7.5,$product->getPrice());


    }
}