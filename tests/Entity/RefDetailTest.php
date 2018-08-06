<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 06/08/2018
 * Time: 14:59
 */

namespace App\Tests\Entity;


use App\Entity\RefDetail;
use PHPUnit\Framework\TestCase;

/**
 * Class RefDetailTest
 * @package App\Tests\Entity
 */
class RefDetailTest extends TestCase
{
    public function testRefDetail()
    {
        $refDetail =  new RefDetail();

        $refDetail->setAddedOn('Y-m-d');
        $refDetail->setName('soda');
        $refDetail->setConstantKey('category');

        self::assertEquals(new \DateTime(date('Y-m-d')), $refDetail->getAddedOn());
        self::assertEquals('soda', $refDetail->getName());
        self::assertEquals('category', $refDetail->getConstantKey());
        self::assertNull($refDetail->getLastModification());
    }
}
