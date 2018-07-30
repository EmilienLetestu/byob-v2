<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 13:05
 */

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NavigationAndRoleTest extends WebTestCase
{
    /**
     * @var
     */
    private $client;


    public function setUp()
    {
        $this->client = static::createClient();
    }


    public function testUserRole()
    {
        $crawler = $this->login('user@gmail.com','directorLolo');

        $this->assertEquals(1, $crawler->filter('#logout')->count());
        $this->assertSame(1, $crawler->filter('h1:contains("Tableau de bord")')->count());
        $this->logout();
    }


    public function testAddWareHouse()
    {
        $crawler = $this->login('user@gmail.com','directorLolo');

        $crawler = $this->client->request('GET','/entrepot/ajouter');
        $this->assertEquals(200,$this->client->getResponse()->getStatusCode());
        $form = $crawler->filter("form")->form();
        $form['ware_house[name]'] = 'jkjjk jkj sssx';
        $form['ware_house[address]'] = 'kkooi ioioi oi';
        $crawler = $this->client->submit($form);

        $this->assertSame('/dashboard', $this->client->getResponse()->headers->get('location'));

        $this->logout();
    }


    /**
     * @param string $username
     * @param string $pswd
     * @return mixed
     */
    private function login(string $username, string $pswd)
    {
        $crawler = $this->client->request('GET','/');
        $this->assertEquals(200,$this->client->getResponse()->getStatusCode());
        $form = $crawler->filter("form")->form();
        $form['_username'] =  $username;
        $form['_password'] =  $pswd;
        $this->client->submit($form);
        return $this->client->followRedirect();
    }

    /**
     * @return mixed
     */
    private function logout(){
        return $this->client->request('GET','/logout');
    }
}