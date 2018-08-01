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
    public const SODA_REFERENCE = 'soda';

    public const BEER_REFERENCE = 'beer';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $soda = new Category();

        $soda->setName('soda');
        $soda->setAddedOn('Y-m-d');
        $soda->setAddedBy($this->getReference(UserFixtures::ADMIN_REFERENCE));

        $manager->persist($soda);
        $manager->flush();

        $this->addReference(self::SODA_REFERENCE, $soda);


        $beer = new Category();

        $beer->setName('biere');
        $beer->setAddedOn('Y-m-d');
        $beer->setAddedBy($this->getReference(UserFixtures::ADMIN_REFERENCE));

        $manager->persist($beer);
        $manager->flush();

        $this->addReference(self::BEER_REFERENCE, $beer);

    }


    /**
     * @return array
     */
   public function getDependencies(): array
   {
       return[UserFixtures::class];
   }
}