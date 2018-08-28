<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 28/08/2018
 * Time: 21:26
 */

namespace App\Repository;


use App\Entity\BackOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class BackOrderRepository extends  ServiceEntityRepository
{
    /***
     * CustomerRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BackOrder::class);
    }

    /**
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countAllToDeliver(): int
    {
        return
            $queryBuilder = $this->createQueryBuilder('b')
            ->select('COUNT(b)')
            ->andWhere('b.prepared = 1')
            ->andWhere('b.delivered = 0')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

}