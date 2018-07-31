<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 17:03
 */

namespace App\DataFixtures;


use App\Entity\Make;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class MakeFixtures
 * @package App\DataFixtures
 */
class MakeFixtures extends Fixture implements DependentFixtureInterface
{
    public const MAKE_REFERENCE = 'make';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $make = new Make();

        $make->setName('The coca-cola company');
        $make->setAddedOn('Y-m-d');
        $make->setAddedBy($this->getReference(UserFixtures::ADMIN_REFERENCE));

        $manager->persist($make);
        $manager->flush();

        $this->addReference(self::MAKE_REFERENCE, $make);
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return[UserFixtures::class];
    }
}