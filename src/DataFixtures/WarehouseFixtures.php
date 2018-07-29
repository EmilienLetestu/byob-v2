<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 29/07/2018
 * Time: 21:09
 */

namespace App\DataFixtures;


use App\Entity\Warehouse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class WarehouseFixtures
 * @package App\DataFixtures
 */
class WarehouseFixtures extends Fixture
{

    public const  WAREHOUSE_REFERENCE = 'warehouse';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $warehouse = new Warehouse();
        $warehouse->setName('Entrepôt fixture');
        $warehouse->setAddress('Rue de la base de données 40 000 Symfony Cedex 4');

        $manager->persist($warehouse);
        $manager->flush();

        $this->addReference(self::WAREHOUSE_REFERENCE, $warehouse);

    }
}