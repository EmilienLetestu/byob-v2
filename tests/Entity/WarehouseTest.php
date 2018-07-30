<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 10:41
 */

namespace App\Tests\Entity;

use App\Entity\Warehouse;
use PHPUnit\Framework\TestCase;

/**
 * Class WarehouseTest
 * @package App\Tests\Entity
 */
class WarehouseTest extends TestCase
{

    public function testWarehouse()
    {
        $warehouse = new Warehouse();

        $warehouse->setName('Entrpôt nord-est');
        $warehouse->setAddress('122 rue StreetName 40000 CityName');

        $this->assertEquals('Entrpôt nord-est', $warehouse->getName());
        $this->assertEquals('122 rue StreetName 40000 CityName', $warehouse->getAddress());
    }
}