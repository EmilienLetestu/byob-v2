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
    public const COCA_REFERENCE = 'coca';

    public const PELFORTH_REFERENCE = 'pelforth';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $coca = new Designation();

        $coca->setName('coca light');
        $coca->setAddedOn('Y-m-d');
        $coca->setAddedBy($this->getReference(UserFixtures::ADMIN_REFERENCE));

        $manager->persist($coca);
        $manager->flush();

        $this->addReference(self::COCA_REFERENCE, $coca);

        $pelforth = new Designation();

        $pelforth->setName('pelforth blonde');
        $pelforth->setAddedOn('Y-m-d');
        $pelforth->setAddedBy($this->getReference(UserFixtures::ADMIN_REFERENCE));

        $manager->persist($pelforth);
        $manager->flush();

        $this->addReference(self::PELFORTH_REFERENCE, $pelforth);
    }


    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return[UserFixtures::class];
    }
}