<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 23:12
 */

namespace App\Tests\Action;

use App\Tests\Action\Security\LoginActionTest;

/**
 * Class CreateUserActionTest
 * @package App\Tests\Action
 */
class CreateUserActionTest extends LoginActionTest
{
    public function testCreateUserAction()
    {
        $crawler = $this->login('admin@gmail.com','adminToto');

        $crawler = $this->client->request('GET','/utilisateur/ajouter');
        $this->assertEquals(200,$this->client->getResponse()->getStatusCode());

        $form = $crawler->filter("form")->form();
        $form['create_user[name]'] = 'functional';
        $form['create_user[surname]'] = 'testing';
        $form['create_user[email]'] = 'testing@gmail.com';
        $form['create_user[role]'] = 'ACCOUNTANT';
        $form['create_user[warehouses]'] = ['5','6'];


        $crawler = $this->client->submit($form);

        $this->assertSame('/dashboard', $this->client->getResponse()->headers->get('location'));

        $this->logout();
    }
}