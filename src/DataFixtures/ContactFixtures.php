<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 29/07/2018
 * Time: 21:08
 */

namespace App\DataFixtures;


use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class ContactFixtures
 * @package App\DataFixtures
 */
class ContactFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $contact = new Contact();

        $contact->setType('personal phone');
        $contact->setData('0606060606');
        $contact->setComment('never before 11 a.m');
        $contact->setPerson(
            $this->getReference(PersonFixtures::PERSON_REFERENCE)
        );

        $manager->persist($contact);
        $manager->flush();

    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return[PersonFixtures::class];
    }
}