<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 09:43
 */

namespace App\Tests\Entity;


use App\Entity\Contact;
use PHPUnit\Framework\TestCase;

/**
 * Class ContactTest
 * @package App\Tests\Entity
 */
class ContactTest extends TestCase
{

    public function testContact()
    {
        $contact = new Contact();

        $contact->setType('Téléphone fixe personnel');
        $contact->setData('0222558877');
        $contact->setComment('Jamais le week-end');

        $this->assertEquals('Téléphone fixe personnel', $contact->getType());
        $this->assertEquals('0222558877', $contact->getData());
        $this->assertEquals('Jamais le week-end', $contact->getComment());
    }
}