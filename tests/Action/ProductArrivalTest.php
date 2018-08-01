<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 18:13
 */

namespace App\Tests\Action;


use App\Tests\Action\Security\LoginActionTest;

class ProductArrivalTest extends LoginActionTest
{
    public function testProductArrivalAction()
    {
        $crawler = $this->login('admin@gmail.com','adminToto');

        $crawler = $this->client->request('GET','/arrivage/produit/1');
        $this->assertEquals(200,$this->client->getResponse()->getStatusCode());
        $this->assertEquals(
            1, $crawler->filter('h1:contains("Arrivage de")')->count()
        );

        $form = $crawler->filter("form")->form();
        $form['product_arrival[quantity]'] = 250;


        $crawler = $this->client->submit($form);

        $this->assertSame('/dashboard', $this->client->getResponse()->headers->get('location'));

        $this->logout();
    }
}