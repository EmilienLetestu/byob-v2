<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 18:54
 */

namespace App\Tests\Action;


use App\Tests\Action\Security\LoginActionTest;

/**
 * Class CreateWarehouseActionTest
 * @package App\Tests\Action
 */
class CreateWarehouseActionTest extends LoginActionTest
{
    public function testCreateWarehouseAction(): void
    {
        $crawler = $this->login('admin@gmail.com','adminToto');

        $crawler = $this->client->request('GET','/entrepot/ajouter');
        $this->assertEquals(200,$this->client->getResponse()->getStatusCode());

        $form = $crawler->filter("form")->form();
        $form['ware_house[name]'] = 'jkjjk jkj sssx';
        $form['ware_house[address]'] = 'kkooi ioioi oi';
        $crawler = $this->client->submit($form);

        $this->assertSame('/dashboard', $this->client->getResponse()->headers->get('location'));

        $this->logout();
    }
}