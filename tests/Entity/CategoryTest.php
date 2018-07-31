<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 17:37
 */

namespace App\Tests\Entity;


use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testCategory()
    {
        $today = new \DateTime(date('Y-m-d'));

        $category = new Category();

        $category->setName('soda');
        $category->setAddedOn('Y-m-d');

        $this->assertEquals('soda', $category->getName());
        $this->assertEquals($today, $category->getAddedOn());
        $this->assertNull($category->getLastModification());
    }
}