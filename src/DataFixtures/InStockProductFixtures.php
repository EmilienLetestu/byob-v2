<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 29/07/2018
 * Time: 21:11
 */

namespace App\DataFixtures;


use App\Entity\InStockProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class InStockProductFixtures
 * @package App\DataFixtures
 */
class InStockProductFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
       $inStockProduct = new InStockProduct();
       $inStockProduct->setLevel(15);
       $inStockProduct->setAlertLevel(10);
       $inStockProduct->setProduct(
           $this->getReference(ProductFixtures::PRODUCT_REFERENCE)
       );
       $inStockProduct->setWarehouse(
           $this->getReference(WarehouseFixtures::FIRST_WAREHOUSE_REFERENCE)
       );

       $manager->persist($inStockProduct);
       $manager->flush();

    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
       return [
           ProductFixtures::class,
           WarehouseFixtures::class
       ];
    }


}