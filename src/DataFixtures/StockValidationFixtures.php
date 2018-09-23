<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 29/07/2018
 * Time: 21:10
 */

namespace App\DataFixtures;


use App\DataFixtures\UserFixtures;
use App\Entity\StockValidation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class StockValidationFixtures
 * @package App\DataFixtures
 */
class StockValidationFixtures extends Fixture implements DependentFixtureInterface
{
    public const STOCK_VALIDATION_REFERENCE = 'stock-validation';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $stockValidation = new StockValidation();
        $stockValidation->setProcessedBy(
            $this->getReference(UserFixtures::LOGISTIC_REFERENCE)
        );
        $stockValidation->setProcessedOn('Y-m-d');
        $stockValidation->setPendingValidation(
            $this->getReference(PendingValidationStockFixtures::PENDING_REFERENCE)
        );

        $manager->persist($stockValidation);
        $manager->flush();

        $this->addReference(self::STOCK_VALIDATION_REFERENCE, $stockValidation);
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [
            UserFixtures::class,
            PendingValidationStockFixtures::class
        ];
    }
}