<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 13:01
 */

namespace App\Tests\Action;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DashboardActionTest extends WebTestCase
{
    public function testDashboardAction(): void
    {
        $client = static::createClient();

        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}