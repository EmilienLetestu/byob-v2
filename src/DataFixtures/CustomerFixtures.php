<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 07/08/2018
 * Time: 20:55
 */

namespace App\DataFixtures;


use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class CustomerFixtures
 * @package App\DataFixtures
 */
class CustomerFixtures extends Fixture implements DependentFixtureInterface
{
    public const CUSTOMER_REFERENCE = "customer";

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
       $customer = new Customer();

       $customer->setAddedOn('Y-m-d');
       $customer->setAddedBy(
           $this->getReference(UserFixtures::ACCOUNTANT_REFERENCE)
       );
       $customer->setCompany('La frite a Nono');

       $manager->persist($customer);
       $manager->flush();

       $this->addReference(self::CUSTOMER_REFERENCE, $customer);
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [UserFixtures::class];
    }
}