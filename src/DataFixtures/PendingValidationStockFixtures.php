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
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $pendingValidation = new PendingValidationStock();
        $pendingValidation->setQuantity(22);
        $pendingValidation->setProcessed(true);
        $pendingValidation->setValidated(false);
        $pendingValidation->setAskedOn('Y-m-d');
        $pendingValidation->setProcessedOn(new \DateTime(date('Y-m-d')));
        $pendingValidation->setStockValidation(
            $this->getReference(StockValidationFixtures::STOCK_VALIDATION_REFERENCE)
        );
        $pendingValidation->setAskedBy(
            $this->getReference(UserFixtures::USER_REFERENCE)
        );
        $pendingValidation->setProduct(
            $this->getReference(ProductFixtures::PRODUCT_REFERENCE)
        );
        $pendingValidation->setWarehouse(
            $this->getReference(WarehouseFixtures::WAREHOUSE_REFERENCE)
        );

        $manager->persist($pendingValidation);
        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            StockValidationFixtures::class,
            UserFixtures::class,
            ProductFixtures::class,
            WarehouseFixtures::class
        ];
    }
}