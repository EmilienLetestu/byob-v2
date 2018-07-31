<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 16:59
 */

namespace App\DataFixtures;


use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TypeFixtures extends Fixture implements DependentFixtureInterface
{
    public const TYPE_REFERENCE = 'type';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $type = new Type();

        $type->setName('boisson');
        $type->setAddedOn('Y-m-d');
        $type->setAddedBy($this->getReference(UserFixtures::ADMIN_REFERENCE));

        $manager->persist($type);
        $manager->flush();

        $this->addReference(self::TYPE_REFERENCE, $type);
    }


    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return[UserFixtures::class];
    }
}