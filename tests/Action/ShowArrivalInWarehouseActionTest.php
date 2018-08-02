<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 02/08/2018
 * Time: 12:27
 */

namespace App\Tests\Action;


use App\Tests\Action\Security\LoginActionTest;

class ShowArrivalInWarehouseActionTest extends LoginActionTest
{
    public function testShowArrivalInWarehouseAction()
    {
        $crawler = $this->login('admin@gmail.com','adminToto');

        $crawler = $this->client->request('GET','/produits/en-attente-de-validation/2');

        $this->assertEquals(200,$this->client->getResponse()->getStatusCode());

        $this->assertEquals(
            1, $crawler->filter('h1:contains("Produit en attente de validation")')->count()
        );

        $this->logout();
    }
}