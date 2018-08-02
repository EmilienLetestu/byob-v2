<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 02/08/2018
 * Time: 12:21
 */

namespace App\Tests\Action;


use App\Tests\Action\Security\LoginActionTest;

class ShowAllWarehouseActionTest extends LoginActionTest
{
    public function testShowAllWarehouseAction()
    {
        $crawler = $this->login('admin@gmail.com','adminToto');

        $crawler = $this->client->request('GET','/entrepot');
        $this->assertEquals(200,$this->client->getResponse()->getStatusCode());

        $this->assertEquals(
            1, $crawler->filter('h1:contains("Liste des entrepôts")')->count()
        );

        $this->logout();
    }
}