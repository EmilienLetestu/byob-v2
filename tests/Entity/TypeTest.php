<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 17:37
 */

namespace App\Tests\Entity;


use App\Entity\Type;
use PHPUnit\Framework\TestCase;

class TypeTest extends TestCase
{
    public function testType()
    {
        $today = new \DateTime(date('Y-m-d'));

        $type = new Type();

        $type->setName('boisson');
        $type->setAddedOn('Y-m-d');

        $this->assertEquals('boisson', $type->getName());
        $this->assertEquals($today, $type->getAddedOn());
        $this->assertNull($type->getLastModification());
    }
}