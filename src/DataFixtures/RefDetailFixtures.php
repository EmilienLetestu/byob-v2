<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 05/08/2018
 * Time: 22:17
 */

namespace App\DataFixtures;


use App\Entity\RefDetail;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RefDetailFixtures extends Fixture implements DependentFixtureInterface
{
    public const FAMILY_DETAIL_REFERENCE     = 'familyDetail';

    public const TYPE_DETAIL_REFERENCE       = 'typeDetail';

    public const SODA_REFERENCE              = 'soda';

    public const BEER_REFERENCE              = 'beer';

    public const COCA_REFERENCE              = 'coca';

    public const PELFORTH_REFERENCE          = 'pelforth';

    public const COCA_COLA_COMPANY_REFERENCE = 'company';

    public const HEINEKEN_REFERENCE          = 'heineken';


    public function load(ObjectManager $manager)
    {
        $soda = new RefDetail();

        $soda->setName('soda');
        $soda->setAddedOn('Y-m-d');
        $soda->setAddedBy(
            $this->getReference(UserFixtures::ADMIN_REFERENCE)
        );
        $soda->setRefMaster(
            $this->getReference(RefMasterFixtures::CATEGORY_REFERENCE)
        );

        $manager->persist($soda);
        $manager->flush();

        $this->addReference(self::SODA_REFERENCE, $soda);


        $beer = new RefDetail();

        $beer->setName('biere');
        $beer->setAddedOn('Y-m-d');
        $beer->setAddedBy(
            $this->getReference(UserFixtures::ADMIN_REFERENCE)
        );
        $beer->setRefMaster(
            $this->getReference(RefMasterFixtures::CATEGORY_REFERENCE)
        );

        $manager->persist($beer);
        $manager->flush();

        $this->addReference(self::BEER_REFERENCE, $beer);

        $family = new RefDetail();

        $family->setName('alimentaire');
        $family->setAddedOn('Y-m-d');
        $family->setAddedBy(
            $this->getReference(UserFixtures::ADMIN_REFERENCE)
        );
        $family->setRefMaster(
            $this->getReference(RefMasterFixtures::FAMILY_REFERENCE)
        );

        $manager->persist($family);
        $manager->flush();

        $this->addReference(self::FAMILY_DETAIL_REFERENCE, $family);

        $type = new RefDetail();

        $type->setName('boisson');
        $type->setAddedOn('Y-m-d');
        $type->setAddedBy(
            $this->getReference(UserFixtures::ADMIN_REFERENCE)
        );
        $family->setRefMaster(
            $this->getReference(RefMasterFixtures::TYPE_REFERENCE)
        );

        $manager->persist($type);
        $manager->flush();

        $this->addReference(self::TYPE_DETAIL_REFERENCE, $type);

        $coca = new RefDetail();

        $coca->setName('coca light');
        $coca->setAddedOn('Y-m-d');
        $coca->setAddedBy(
            $this->getReference(UserFixtures::ADMIN_REFERENCE)
        );
        $coca->setRefMaster(
            $this->getReference(RefMasterFixtures::DESIGNATION_REFERENCE)
        );

        $manager->persist($coca);
        $manager->flush();

        $this->addReference(self::COCA_REFERENCE, $coca);

        $pelforth = new RefDetail();

        $pelforth->setName('pelforth blonde');
        $pelforth->setAddedOn('Y-m-d');
        $pelforth->setAddedBy(
            $this->getReference(UserFixtures::ADMIN_REFERENCE)
        );
        $pelforth->setRefMaster(
            $this->getReference(RefMasterFixtures::DESIGNATION_REFERENCE)
        );

        $manager->persist($pelforth);
        $manager->flush();

        $this->addReference(self::PELFORTH_REFERENCE, $pelforth);

        $company = new RefDetail();

        $company->setName('The coca-cola company');
        $company->setAddedOn('Y-m-d');
        $company->setAddedBy(
            $this->getReference(UserFixtures::ADMIN_REFERENCE)
        );
        $company->setRefMaster(
            $this->getReference(RefMasterFixtures::MAKE_REFERENCE)
        );

        $manager->persist($company);
        $manager->flush();

        $this->addReference(self::COCA_COLA_COMPANY_REFERENCE, $company);

        $heineken = new RefDetail();

        $heineken->setName('Heineken');
        $heineken->setAddedOn('Y-m-d');
        $heineken->setAddedBy(
            $this->getReference(UserFixtures::ADMIN_REFERENCE)
        );
        $heineken->setRefMaster(
            $this->getReference(RefMasterFixtures::MAKE_REFERENCE)
        );

        $manager->persist($heineken);
        $manager->flush();

        $this->addReference(self::HEINEKEN_REFERENCE, $heineken);
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            RefMasterFixtures::class
        ];
    }

}
