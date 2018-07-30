<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 09:48
 */

namespace App\Tests\Entity;


use App\Entity\Person;
use PHPUnit\Framework\TestCase;

/**
 * Class PersonTest
 * @package App\Tests\Entity
 */
class PersonTest extends TestCase
{
    public function testPerson()
    {
        $date = \DateTime::createFromFormat('Y-m-d', '1980-05-19');
        
        $person = new Person();

        $person->setFullName('Emilien Letestu');
        $person->setJob('client');
        $person->setBirthday($date);

        $this->assertEquals('Emilien Letestu', $person->getFullName());
        $this->assertEquals('client', $person->getJob());
        $this->assertEquals($date, $person->getBirthday());
    }
}