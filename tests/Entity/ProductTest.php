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

        $product->setFamily('alimentaire');
        $product->setType('boisson');
        $product->setCategory('soda');
        $product->setMake('The coca-cola company');
        $product->setModel('coca-cola light');
        $product->setDesignation('Coca-cola ligth bouteille plastique 50cl');
        $product->setReference('787787487');
        $product->setReferencedOn('Y-m-d');

        $this->assertEquals('alimentaire', $product->getFamily());
        $this->assertEquals('boisson', $product->getType());
        $this->assertEquals('soda', $product->getCategory());
        $this->assertEquals('The coca-cola company', $product->getMake());
        $this->assertEquals('coca-cola light', $product->getModel());
        $this->assertEquals('Coca-cola ligth bouteille plastique 50cl',$product->getDesignation());
        $this->assertEquals('787787487', $product->getReference());
        $this->assertEquals($today, $product->getReferencedOn());
        $this->assertNull($product->getLastModification());


    }
}