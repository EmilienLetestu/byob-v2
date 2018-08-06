<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 06/08/2018
 * Time: 15:04
 */

namespace App\Tests\Entity;


use App\Entity\RefMaster;
use PHPUnit\Framework\TestCase;

class RefMasterTest extends TestCase
{
    public function testRefMaster()
    {
        $refMaster = new RefMaster();

        $refMaster->setName('category');
        $refMaster->setAddedOn('Y-m-d');

        self::assertEquals('category', $refMaster->getName());
        self::assertEquals(new \DateTime(date('Y-m-d')), $refMaster->getAddedOn());
        self::assertNull($refMaster->getLastModification());
    }

}