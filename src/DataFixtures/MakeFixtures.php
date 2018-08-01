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
    public const COCA_COLA_COMPANY_REFERENCE = 'company';

    public const HEINEKEN_REFERENCE = 'heineken';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $company = new Make();

        $company->setName('The coca-cola company');
        $company->setAddedOn('Y-m-d');
        $company->setAddedBy($this->getReference(UserFixtures::ADMIN_REFERENCE));

        $manager->persist($company);
        $manager->flush();

        $this->addReference(self::COCA_COLA_COMPANY_REFERENCE, $company);

        $heineken = new Make();

        $heineken->setName('Heineken');
        $heineken->setAddedOn('Y-m-d');
        $heineken->setAddedBy($this->getReference(UserFixtures::ADMIN_REFERENCE));

        $manager->persist($heineken);
        $manager->flush();

        $this->addReference(self::HEINEKEN_REFERENCE, $heineken);
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return[UserFixtures::class];
    }
}