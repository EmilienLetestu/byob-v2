<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 02/08/2018
 * Time: 12:19
 */

namespace App\Tests\Action;


use App\Tests\Action\Security\LoginActionTest;

class testShowAllUser extends LoginActionTest
{
    public function testShowAllProductAction()
    {
        $crawler = $this->login('admin@gmail.com','adminToto');

        $crawler = $this->client->request('GET','/utilisateur');
        $this->assertEquals(200,$this->client->getResponse()->getStatusCode());

        $this->assertEquals(
            1, $crawler->filter('h1:contains("Liste des utilisateurs")')->count()
        );

        $this->logout();
    }
}