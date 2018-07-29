<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 29/07/2018
 * Time: 21:09
 */

namespace App\DataFixtures;


use App\Entity\Orders;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class OrderFixtures
 * @package App\DataFixtures
 */
class OrdersFixtures extends Fixture implements DependentFixtureInterface
{

    public const ORDER_REFERENCE = 'order';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
       $order =  new Orders();

       $order->setReference('cmd_');
       $order->setOrderedOn('Y-m-d');
       $order->setStatus('en atente de livraison');
       $order->setOrderedBy(
           $this->getReference(UserFixtures::USER_REFERENCE)
       );
       $order->setOrderedFor(
           $this->getReference(PersonFixtures::PERSON_REFERENCE)
       );

       $manager->persist($order);
       $manager->flush();

       $this->addReference(self::ORDER_REFERENCE, $order);



    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
       return  [
           UserFixtures::class,
           PersonFixtures::class
       ];
    }
}