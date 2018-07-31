<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 17:00
 */

namespace App\DataFixtures;


use App\Entity\Family;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class FamilyFixtures extends Fixture implements DependentFixtureInterface
{
    public const FAMILY_REFERENCE = 'family';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $family = new Family();

        $family->setName('alimentaire');
        $family->setAddedOn('Y-m-d');
        $family->setAddedBy($this->getReference(UserFixtures::ADMIN_REFERENCE));

        $manager->persist($family);
        $manager->flush();

        $this->addReference(self::FAMILY_REFERENCE, $family);
    }


    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return[UserFixtures::class];
    }

}