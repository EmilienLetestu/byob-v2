<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 22:14
 */

namespace App\Repository;


use App\Entity\Orders;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class OrdersRepository extends ServiceEntityRepository
{
    /**
     * OrdersRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Orders::class);
    }

    /**
     * @return array
     */
    public function findAllOrder():array
    {
        return
            $queryBuilder = $this->createQueryBuilder('o')
            ->Select('o')
            ->orderBy('o.orderedOn', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
}