<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 17:01
 */

namespace App\DataFixtures;


use App\Entity\Designation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DesignationFixtures extends Fixture implements DependentFixtureInterface
{
    public const DESIGNATION_REFERENCE = 'designation';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $designation = new Designation();

        $designation->setName('coca light');
        $designation->setAddedOn('Y-m-d');
        $designation->setAddedBy($this->getReference(UserFixtures::ADMIN_REFERENCE));

        $manager->persist($designation);
        $manager->flush();

        $this->addReference(self::DESIGNATION_REFERENCE, $designation);
    }


    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return[UserFixtures::class];
    }
}