<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 05/08/2018
 * Time: 22:17
 */

namespace App\DataFixtures;

use App\Entity\RefMaster;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RefMasterFixtures extends Fixture implements DependentFixtureInterface
{

    public const FAMILY_REFERENCE      = 'family';

    public const TYPE_REFERENCE        = 'type';

    public const CATEGORY_REFERENCE    = 'category';

    public const MAKE_REFERENCE        = 'make';

    public const DESIGNATION_REFERENCE = 'designation';


    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
       $family = new RefMaster();

       $family->setName('family');
       $family->setAddedOn('Y-m-d');
       $family->setAddedBy(
           $this->getReference(UserFixtures::ADMIN_REFERENCE)
       );

       $manager->persist($family);
       $manager->flush();

       $this->addReference(self::FAMILY_REFERENCE, $family);

       $type = new RefMaster();

       $type->setName('type');
       $type->setAddedOn('Y-m-d');
       $type->setAddedBy(
           $this->getReference(UserFixtures::ADMIN_REFERENCE)
       );

       $manager->persist($type);
       $manager->flush();

       $this->addReference(self::TYPE_REFERENCE, $type);

       $category = new RefMaster();

       $category->setName('category');
       $category->setAddedOn('Y-m-d');
       $category->setAddedBy(
           $this->getReference(UserFixtures::ADMIN_REFERENCE)
       );

       $manager->persist($category);
       $manager->flush();

       $this->addReference(self::CATEGORY_REFERENCE, $category);

       $make = new RefMaster();

       $make->setName('make');
       $make->setAddedOn('Y-m-d');
       $make->setAddedBy(
           $this->getReference(UserFixtures::ADMIN_REFERENCE)
       );

       $manager->persist($make);
       $manager->flush();

       $this->addReference(self::MAKE_REFERENCE, $make);

       $designation = new RefMaster();

       $designation->setName('designation');
       $designation->setAddedOn('Y-m-d');
       $designation->setAddedBy(
           $this->getReference(UserFixtures::ADMIN_REFERENCE)
       );

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