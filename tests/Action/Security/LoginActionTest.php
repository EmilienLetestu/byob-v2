<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 12:56
 */

namespace App\Tests\Action\Security;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginActionTest extends WebTestCase
{
    public function testLoginAction(): void
    {
        $client = static::createClient();

        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}