<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 02/08/2018
 * Time: 12:30
 */

namespace App\Tests\Action;


use App\Tests\Action\Security\LoginActionTest;

class ShowProductActionTest extends LoginActionTest
{
    public function testShowArrivalInWarehouseAction()
    {
        $crawler = $this->login('admin@gmail.com','adminToto');

        $crawler = $this->client->request('GET','/produit/1');
        $this->assertEquals(200,$this->client->getResponse()->getStatusCode());

        $this->assertEquals(
            1, $crawler->filter('h1:contains("coca-cola light cannette 33cl")')->count()
        );

        $this->logout();
    }
}