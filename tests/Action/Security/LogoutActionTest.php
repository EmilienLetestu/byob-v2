<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 12:59
 */

namespace App\Tests\Action\Security;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LogoutActionTest extends WebTestCase
{
    public function testLogoutAction(): void
    {
        $client = static::createClient();

        $client->request('GET', '/logout');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}