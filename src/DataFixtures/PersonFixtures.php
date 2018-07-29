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
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class PersonFixtures
 * @package App\DataFixtures
 */
class PersonFixtures extends Fixture
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

        $manager->persist($person);
        $manager->flush();

        $this->addReference(self::PERSON_REFERENCE, $person);
    }

}