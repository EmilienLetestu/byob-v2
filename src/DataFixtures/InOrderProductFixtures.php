<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 29/07/2018
 * Time: 21:10
 */

namespace App\DataFixtures;


use App\Entity\InOrderProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class InOrderProductFixtures
 * @package App\DataFixtures
 */
class InOrderProductFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $inOrderProduct = new InOrderProduct();
        $inOrderProduct->setQuantity(15);
        $inOrderProduct->setOrder(
            $this->getReference(OrdersFixtures::ORDER_REFERENCE)
        );
        $inOrderProduct->setProduct(
            $this->getReference(ProductFixtures::PRODUCT_REFERENCE)
        );

        $manager->persist($inOrderProduct);
        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            OrdersFixtures::class,
            ProductFixtures::class
        ];
    }
}