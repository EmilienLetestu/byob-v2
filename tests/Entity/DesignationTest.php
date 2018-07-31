<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 17:39
 */

namespace App\Tests\Entity;


use App\Entity\Designation;
use PHPUnit\Framework\TestCase;

class DesignationTest extends TestCase
{
    public function testDesignation()
    {
        $today = new \DateTime(date('Y-m-d'));

        $designation = new Designation();

        $designation->setName('coca-cola');
        $designation->setAddedOn('Y-m-d');

        $this->assertEquals('coca-cola', $designation->getName());
        $this->assertEquals($today, $designation->getAddedOn());
        $this->assertNull($designation->getLastModification());
    }
}