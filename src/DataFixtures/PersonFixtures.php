<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 29/07/2018
 * Time: 21:08
 */

namespace App\DataFixtures;


use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class PersonFixtures
 * @package App\DataFixtures
 */
class PersonFixtures extends Fixture implements DependentFixtureInterface
{
    public const PERSON_REFERENCE = 'person';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $person = new Person();
        $person->setFullName("Nono LeRobot");
        $person->setJob('client');
        $person->setCustomer(
            $this->getReference(CustomerFixtures::CUSTOMER_REFERENCE)
        );

        $manager->persist($person);
        $manager->flush();

        $this->addReference(self::PERSON_REFERENCE, $person);
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [CustomerFixtures::class];
    }

}