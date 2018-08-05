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
    public const ADMIN_REFERENCE = 'admin';
    public const ACCOUNTANT_REFERENCE  = 'accountant';
    public const SUPPLY_REFERENCE  = 'supply';
    public const LOGISTIC_REFERENCE = 'logistic';
    public const SALESMAN_REFERENCE = 'salesman';
    public const WAREHOUSEMAN_REFERENCE = 'warehouseman';
    public const DELIVERYMAN_REFERENCE = 'deliveryman';


    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
      $accountant = new User();

      $accountant->setName('Lolo');
      $accountant->setSurname('Durant');
      $accountant->setEmail('accountant@gmail.com');
      $accountant->setPassword('accountantLolo');
      $accountant->setRole('ACCOUNTANT');
      $accountant->setAddedOn('Y-m-d');
      $accountant->setActivated(true);
      $accountant->setActivatedOn(
          new \DateTime(date('Y-m-d'))
      );
      $accountant->addWarehouse(
           $this->getReference(WarehouseFixtures::FIRST_WAREHOUSE_REFERENCE)
      );
      $manager->persist($accountant);
      $manager->flush();

      $this->addReference(self::ACCOUNTANT_REFERENCE, $accountant);

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
      $admin->addWarehouse(
          $this->getReference(WarehouseFixtures::FIRST_WAREHOUSE_REFERENCE)
      );
      $admin->addWarehouse(
          $this->getReference(WarehouseFixtures::SECOND_WAREHOUSE_REFERENCE)
      );

      $manager->persist($admin);
      $manager->flush();

      $this->addReference(self::ADMIN_REFERENCE, $admin);

      $supply = new User();

      $supply->setName('Gogo');
      $supply->setSurname('Durant');
      $supply->setEmail('supply@gmail.com');
      $supply->setPassword('supplyGogo');
      $supply->setRole('SUPPLY');
      $supply->setAddedOn('Y-m-d');
      $supply->setActivated(true);
      $supply->setActivatedOn(
            new \DateTime(date('Y-m-d'))
      );
      $supply->addWarehouse(
          $this->getReference(WarehouseFixtures::FIRST_WAREHOUSE_REFERENCE)
      );
      $manager->persist($supply);
      $manager->flush();

      $this->addReference(self::SUPPLY_REFERENCE, $supply);

      $logistic = new User();

      $logistic->setName('Coco');
      $logistic->setSurname('Durant');
      $logistic->setEmail('logistic@gmail.com');
      $logistic->setPassword('logisticCoco');
      $logistic->setRole('LOGISTIC');
      $logistic->setAddedOn('Y-m-d');
      $logistic->setActivated(true);
      $logistic->setActivatedOn(
            new \DateTime(date('Y-m-d'))
      );
      $logistic->addWarehouse(
          $this->getReference(WarehouseFixtures::FIRST_WAREHOUSE_REFERENCE)
      );
      $manager->persist($logistic);
      $manager->flush();

      $this->addReference(self::LOGISTIC_REFERENCE, $logistic);

      $warehouseman = new User();

      $warehouseman->setName('Bobo');
      $warehouseman->setSurname('Durant');
      $warehouseman->setEmail('warehouseman@gmail.com');
      $warehouseman->setPassword('warehousemanBobo');
      $warehouseman->setRole('WAREHOUSEMAN');
      $warehouseman->setAddedOn('Y-m-d');
      $warehouseman->setActivated(true);
      $warehouseman->setActivatedOn(
            new \DateTime(date('Y-m-d'))
      );
      $warehouseman->addWarehouse(
          $this->getReference(WarehouseFixtures::FIRST_WAREHOUSE_REFERENCE)
      );
      $manager->persist($warehouseman);
      $manager->flush();

      $this->addReference(self::WAREHOUSEMAN_REFERENCE, $warehouseman);

      $salesman = new User();

      $salesman->setName('Momo');
      $salesman->setSurname('Durant');
      $salesman->setEmail('salesman@gmail.com');
      $salesman->setPassword('salesmanMomo');
      $salesman->setRole('SALESMAN');
      $salesman->setAddedOn('Y-m-d');
      $salesman->setActivated(true);
      $salesman->setActivatedOn(
            new \DateTime(date('Y-m-d'))
      );
      $salesman->addWarehouse(
          $this->getReference(WarehouseFixtures::FIRST_WAREHOUSE_REFERENCE)
      );
      $manager->persist($salesman);
      $manager->flush();

      $this->addReference(self::SALESMAN_REFERENCE, $salesman);

      $deliveryman = new User();

      $deliveryman->setName('Nono');
      $deliveryman->setSurname('Durant');
      $deliveryman->setEmail('deliveryman@gmail.com');
      $deliveryman->setPassword('deliverymanNono');
      $deliveryman->setRole('DELIVERYMAN');
      $deliveryman->setAddedOn('Y-m-d');
      $deliveryman->setActivated(true);
      $deliveryman->setActivatedOn(
            new \DateTime(date('Y-m-d'))
      );
      $deliveryman->addWarehouse(
          $this->getReference(WarehouseFixtures::FIRST_WAREHOUSE_REFERENCE)
      );
      $manager->persist($deliveryman);
      $manager->flush();

      $this->addReference(self::DELIVERYMAN_REFERENCE, $deliveryman);
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return[WarehouseFixtures::class];
    }

}