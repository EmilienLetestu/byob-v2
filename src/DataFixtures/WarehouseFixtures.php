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

    public const  FIRST_WAREHOUSE_REFERENCE = 'first';

    public const  SECOND_WAREHOUSE_REFERENCE = 'second';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $first = new Warehouse();
        $first->setName('Entrepôt fixture');
        $first->setAddress('Rue de la base de données 40 000 Symfony Cedex 4');

        $manager->persist($first);
        $manager->flush();

        $this->addReference(self::FIRST_WAREHOUSE_REFERENCE, $first);

        $second = new Warehouse();
        $second->setName('Entrepôt bam');
        $second->setAddress('Rue des fixtures 40 000 Symfony Cedex 4');

        $manager->persist($second);
        $manager->flush();

        $this->addReference(self::SECOND_WAREHOUSE_REFERENCE, $second);

    }
}