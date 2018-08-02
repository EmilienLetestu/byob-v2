<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 12:56
 */

namespace App\Tests\Action\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class LoginActionTest
 * @package App\Tests\Action\Security
 */
class LoginActionTest extends WebTestCase
{
    /**
     * @var
     */
    protected $client;


    public function setUp()
    {
        $this->client = static::createClient();
    }
    /**
     * @param string $username
     * @param string $pswd
     * @return mixed
     */
    public function login(string $username, string $pswd)
    {
        $crawler = $this->client->request('GET','/');
        $this->assertEquals(200,$this->client->getResponse()->getStatusCode());
        $form = $crawler->filter("form")->form();
        $form['_username'] =  $username;
        $form['_password'] =  $pswd;
        $this->client->submit($form);
        return $this->client->followRedirect();
    }


    public function testLoginAction(): void
    {
        $client = static::createClient();

        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $crawler = $this->login('admin@gmail.com','adminToto');

        $this->assertSame(1, $crawler->filter('h1:contains("Tableau de bord")')->count());
    }

    /**
     * @return mixed
     */
    public function logout(){
        return $this->client->request('GET','/logout');
    }
}