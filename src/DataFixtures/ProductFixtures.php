<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 29/07/2018
 * Time: 21:09
 */

namespace App\DataFixtures;


use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class ProductFixtures
 * @package App\DataFixtures
 */
class ProductFixtures extends Fixture implements DependentFixtureInterface
{

    public const PRODUCT_REFERENCE = 'product';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $product->setModel('coca-cola light cannette 33cl');
        $product->setReference('coca-7848748');
        $product->setReferencedOn('Y-m-d');

        $product->setReferencedBy(
            $this->getReference(UserFixtures::SUPPLY_REFERENCE)
        );

        $product->setPrice(7.58);

        $product->setFamily(
            $this->getReference(RefDetailFixtures::FAMILY_DETAIL_REFERENCE)
        );

        $product->setType(
            $this->getReference(RefDetailFixtures::TYPE_DETAIL_REFERENCE)
        );

        $product->setMake(
            $this->getReference(RefDetailFixtures::COCA_COLA_COMPANY_REFERENCE)
        );

        $product->setCategory(
            $this->getReference(RefDetailFixtures::SODA_REFERENCE)
        );

        $product->setDesignation(
            $this->getReference(RefDetailFixtures::COCA_REFERENCE)
        );

        $manager->persist($product);
        $manager->flush();

        $this->addReference(self::PRODUCT_REFERENCE, $product);
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            RefDetailFixtures::class
        ];
    }
}