<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 18:54
 */

namespace App\Tests\Action;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateWarehouseActionTest extends WebTestCase
{
    public function testCreateWarehouseAction(): void
    {
        $client = static::createClient();

        $client->request('GET', '/entrepot/ajouter');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}