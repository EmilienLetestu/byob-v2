<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 29/07/2018
 * Time: 21:08
 */

namespace App\DataFixtures;


use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class UserFixtures
 * @package App\DataFixtures
 */
class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public const USER_REFERENCE  = 'user';
    public const ADMIN_REFERENCE = 'admin';


    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
      $user = new User();

      $user->setName('Lolo');
      $user->setSurname('Durant');
      $user->setEmail('director@gmail.com');
      $user->setPassword('directorLolo');
      $user->setRole('DIRECTOR');
      $user->setAddedOn('Y-m-d');
      $user->setActivated(true);
      $user->setActivatedOn(
          new \DateTime(date('Y-m-d'))
      );
      $user->setWarehouse(
           $this->getReference(WarehouseFixtures::WAREHOUSE_REFERENCE)
      );
      $manager->persist($user);
      $manager->flush();

      $this->addReference(self::USER_REFERENCE, $user);

      $admin = new User();

      $admin->setName('Toto');
      $admin->setSurname('Dupont');
      $admin->setEmail('admin@gmail.com');
      $admin->setPassword('adminToto');
      $admin->setRole('ADMIN');
      $admin->setAddedOn('Y-m-d');
      $admin->setActivated(true);
      $admin->setActivatedOn(
            new \DateTime(date('Y-m-d'))
      );
      $admin->setWarehouse(
          $this->getReference(WarehouseFixtures::WAREHOUSE_REFERENCE)
      );
      $manager->persist($admin);
      $manager->flush();

      $this->addReference(self::ADMIN_REFERENCE, $admin);
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return[WarehouseFixtures::class];
    }

}