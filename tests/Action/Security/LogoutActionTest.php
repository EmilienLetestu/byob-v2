<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 12:59
 */

namespace App\Tests\Action\Security;

class LogoutActionTest extends LoginActionTest
{
    public function testLogoutAction(): void
    {
        $client = static::createClient();

        $crawler = $this->login('admin@gmail.com','adminToto');

        $client->request('GET', '/logout');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());

    }
}