<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 09:00
 */

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 * @package App\Tests\Entity
 */
class UserTest extends TestCase
{
    public function testUser()
    {
        $today = new \DateTime(date('Y-m-d'));

        $user = new User();

        $user->setName('Nono');
        $user->setSurname('Le Robot');
        $user->setEmail('nono31@gmail.com');
        $user->setPassword('nono3131');
        $user->setRole('WAREHOUSEMAN');
        $user->setAddedOn('Y-m-d');


        $this->assertEquals('Nono', $user->getName());
        $this->assertEquals('Le Robot', $user->getSurname());
        $this->assertEquals('nono31@gmail.com', $user->getEmail());
        $this->assertInternalType('string', $user->getPassword());
        $this->assertEquals('WAREHOUSEMAN', $user->getRole());
        $this->assertEquals($today, $user->getAddedOn());
        $this->assertEquals(false, $user->getActivated());
        $this->assertEquals(null, $user->getActivatedOn());

    }
}
