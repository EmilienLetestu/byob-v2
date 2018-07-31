<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 17:00
 */

namespace App\DataFixtures;


use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public const CATEGORY_REFERENCE = 'category';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $category = new Category();

        $category->setName('soda');
        $category->setAddedOn('Y-m-d');
        $category->setAddedBy($this->getReference(UserFixtures::ADMIN_REFERENCE));

        $manager->persist($category);
        $manager->flush();

        $this->addReference(self::CATEGORY_REFERENCE, $category);
    }


    /**
     * @return array
     */
   public function getDependencies(): array
   {
       return[UserFixtures::class];
   }
}