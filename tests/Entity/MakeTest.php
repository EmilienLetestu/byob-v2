<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 17:40
 */

namespace App\Tests\Entity;


use App\Entity\Make;
use PHPUnit\Framework\TestCase;

class MakeTest extends TestCase
{
    public function testMake()
    {
        $today = new \DateTime(date('Y-m-d'));

        $make = new Make();

        $make->setName('The coca-cola company');
        $make->setAddedOn('Y-m-d');

        $this->assertEquals('The coca-cola company', $make->getName());
        $this->assertEquals($today, $make->getAddedOn());
        $this->assertNull($make->getLastModification());
    }
}