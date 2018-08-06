<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 06/08/2018
 * Time: 13:00
 */

namespace App\DataFixtures;


use App\Entity\UserInWarehouse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class UserInWarehouseFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $adminWarehouse = new UserInWarehouse();

        $adminWarehouse->setAddedOn('Y-m-d');
        $adminWarehouse->setWarehouse(
            $this->getReference(WarehouseFixtures::FIRST_WAREHOUSE_REFERENCE)
        );

        $adminWarehouse->setUser(
            $this->getReference(UserFixtures::ADMIN_REFERENCE)
        );

        $manager->persist($adminWarehouse);
        $manager->flush();

        $adminWarehouse2 = new UserInWarehouse();

        $adminWarehouse2->setAddedOn('Y-m-d');
        $adminWarehouse2->setWarehouse(
            $this->getReference(WarehouseFixtures::SECOND_WAREHOUSE_REFERENCE)
        );

        $adminWarehouse2->setUser(
            $this->getReference(UserFixtures::ADMIN_REFERENCE)
        );

        $manager->persist($adminWarehouse2);
        $manager->flush();

        $accountantWarehouse = new UserInWarehouse();

        $accountantWarehouse->setAddedOn('Y-m-d');
        $accountantWarehouse->setWarehouse(
            $this->getReference(WarehouseFixtures::FIRST_WAREHOUSE_REFERENCE)
        );

        $accountantWarehouse->setUser(
            $this->getReference(UserFixtures::ACCOUNTANT_REFERENCE)
        );

        $manager->persist($accountantWarehouse);
        $manager->flush();

        $supplyWarehouse = new UserInWarehouse();

        $supplyWarehouse->setAddedOn('Y-m-d');
        $supplyWarehouse->setWarehouse(
            $this->getReference(WarehouseFixtures::FIRST_WAREHOUSE_REFERENCE)
        );

        $supplyWarehouse->setUser(
            $this->getReference(UserFixtures::SUPPLY_REFERENCE)
        );

        $manager->persist($supplyWarehouse);
        $manager->flush();

        $logisticWarehouse = new UserInWarehouse();

        $logisticWarehouse->setAddedOn('Y-m-d');
        $logisticWarehouse->setWarehouse(
            $this->getReference(WarehouseFixtures::FIRST_WAREHOUSE_REFERENCE)
        );

        $logisticWarehouse->setUser(
            $this->getReference(UserFixtures::LOGISTIC_REFERENCE)
        );

        $manager->persist($logisticWarehouse);
        $manager->flush();

        $salesmanWarehouse = new UserInWarehouse();

        $salesmanWarehouse->setAddedOn('Y-m-d');
        $salesmanWarehouse->setWarehouse(
            $this->getReference(WarehouseFixtures::FIRST_WAREHOUSE_REFERENCE)
        );

        $salesmanWarehouse->setUser(
            $this->getReference(UserFixtures::SALESMAN_REFERENCE)
        );

        $manager->persist($salesmanWarehouse);
        $manager->flush();

        $warehousemanWarehouse = new UserInWarehouse();

        $warehousemanWarehouse->setAddedOn('Y-m-d');
        $warehousemanWarehouse->setWarehouse(
            $this->getReference(WarehouseFixtures::FIRST_WAREHOUSE_REFERENCE)
        );

        $warehousemanWarehouse->setUser(
            $this->getReference(UserFixtures::WAREHOUSEMAN_REFERENCE)
        );

        $manager->persist($warehousemanWarehouse);
        $manager->flush();


        $deliverymanWarehouse = new UserInWarehouse();

        $deliverymanWarehouse->setAddedOn('Y-m-d');
        $deliverymanWarehouse->setWarehouse(
            $this->getReference(WarehouseFixtures::FIRST_WAREHOUSE_REFERENCE)
        );

        $deliverymanWarehouse->setUser(
            $this->getReference(UserFixtures::DELIVERYMAN_REFERENCE)
        );

        $manager->persist($deliverymanWarehouse);
        $manager->flush();


    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            WarehouseFixtures::class
        ];
    }
}