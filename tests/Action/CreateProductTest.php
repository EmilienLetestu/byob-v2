<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 23:13
 */

namespace App\Tests\Action;


use App\Tests\Action\Security\LoginActionTest;

/**
 * Class CreateProductTest
 * @package App\Tests\Action
 */
class CreateProductTest extends LoginActionTest
{
    public function testCreateProductAction()
    {
        $crawler = $this->login('admin@gmail.com','adminToto');

        $crawler = $this->client->request('GET','/produit/ajouter');
        $this->assertEquals(200,$this->client->getResponse()->getStatusCode());

        $form = $crawler->filter("form")->form();
        $form['product[family]'] = '1';
        $form['product[category]'] = '1';
        $form['product[type]'] = '1';
        $form['product[make]'] = '1';
        $form['product[designation]'] = '3';
        $form['product[model]'] = 'coca-cola zero bouteille verre 33cl';

        $crawler = $this->client->submit($form);

        $this->assertSame('/dashboard', $this->client->getResponse()->headers->get('location'));

        $this->logout();
    }
}