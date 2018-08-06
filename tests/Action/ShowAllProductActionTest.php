<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 17:59
 */

namespace App\Tests\Action;


use App\Tests\Action\Security\LoginActionTest;

class ShowAllProductActionTest extends LoginActionTest
{
    public function testShowAllProductAction()
    {
        $crawler = $this->login('admin@gmail.com','adminToto');

        $crawler = $this->client->request('GET','/produit');
        $this->assertEquals(200,$this->client->getResponse()->getStatusCode());

        $this->assertEquals(
            1, $crawler->filter('h1:contains("Catalogue produits")')->count()
        );

        $this->logout();
    }
}