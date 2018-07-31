<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 17:39
 */

namespace App\Tests\Entity;


use App\Entity\Family;
use PHPUnit\Framework\TestCase;

class FamilyTest extends TestCase
{
    public function testFamily()
    {
        $today = new \DateTime(date('Y-m-d'));

        $family = new Family();

        $family->setName('alimentaire');
        $family->setAddedOn('Y-m-d');

        $this->assertEquals('alimentaire', $family->getName());
        $this->assertEquals($today, $family->getAddedOn());
        $this->assertNull($family->getLastModification());
    }
}