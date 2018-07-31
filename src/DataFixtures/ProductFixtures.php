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
        $product->setModel('coca-cola');
        $product->setReference('coca-7848748');
        $product->setReferencedOn('Y-m-d');
        $product->setFamily(
            $this->getReference(FamilyFixtures::FAMILY_REFERENCE)
        );
        $product->setType(
            $this->getReference(TypeFixtures::TYPE_REFERENCE)
        );
        $product->setCategory(
            $this->getReference(CategoryFixtures::CATEGORY_REFERENCE)
        );
        $product->setMake(
            $this->getReference(MakeFixtures::MAKE_REFERENCE)
        );
        $product->setDesignation(
            $this->getReference(DesignationFixtures::DESIGNATION_REFERENCE)
        );
        $product->setReferencedBy(
            $this->getReference(UserFixtures::SUPPLY_REFERENCE)
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
            FamilyFixtures::class,
            TypeFixtures::class,
            CategoryFixtures::class,
            MakeFixtures::class,
            DesignationFixtures::class,
            UserFixtures::class
        ];
    }
}