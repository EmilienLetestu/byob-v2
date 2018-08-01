<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 29/07/2018
 * Time: 21:10
 */

namespace App\DataFixtures;


use App\Entity\PendingValidationStock;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class PendingValidationStockFixtures
 * @package App\DataFixtures
 */
class PendingValidationStockFixtures extends Fixture implements DependentFixtureInterface
{
    public const PENDING_REFERENCE = 'pending';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $pending = new PendingValidationStock();
        $pending->setQuantity(22);
        $pending->setProcessed(true);
        $pending->setValidated(false);
        $pending->setAskedOn('Y-m-d');
        $pending->setProcessedOn(new \DateTime(date('Y-m-d')));
        $pending->setAskedBy(
            $this->getReference(UserFixtures::WAREHOUSEMAN_REFERENCE)
        );
        $pending->setProduct(
            $this->getReference(ProductFixtures::PRODUCT_REFERENCE)
        );
        $pending->setWarehouse(
            $this->getReference(WarehouseFixtures::WAREHOUSE_REFERENCE)
        );

        $manager->persist($pending);
        $manager->flush();

        $this->addReference(self::PENDING_REFERENCE, $pending);
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            ProductFixtures::class,
            WarehouseFixtures::class
        ];
    }
}