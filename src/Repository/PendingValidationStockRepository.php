<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 23:59
 */

namespace App\Repository;


use App\Entity\PendingValidationStock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PendingValidationStockRepository extends ServiceEntityRepository
{
    /***
     * PendingValidationStockRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PendingValidationStock::class);
    }

    /**
     * @return array
     */
    public function findAllPendingValidation(): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('pe')
             ->where('pe.processed = 0')
             ->orderBy('pe.askedOn', 'DESC')
             ->getQuery()
             ->getResult()
        ;
    }

    /**
     * @param int $id
     * @return array
     */
    public function findAllPendingWithProduct(int $id): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('pe')
            ->where('pe.product = :id')
            ->andWhere('pe.processed = 0')
            ->orderBy('pe.askedOn', 'DESC')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param $id
     * @return array
     */
    public function findAllPendingFromWarehouse(int $id): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('pe')
            ->where('pe.warehouse = :id')
            ->andWhere('pe.processed = 0')
            ->orderBy('pe.askedOn', 'DESC')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

    }

    /**
     * @param int $id
     * @return PendingValidationStock|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findPendingWithId(int $id):? PendingValidationStock
    {
        return
            $queryBuilder = $this->createQueryBuilder('pe')
            ->where('pe.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * @return array
     */
    public function findAllArrival(): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('pe')
            ->where('pe.processed = 0')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param int $id
     * @return array
     */
    public function findAllArrivalWithUser(int $id): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('pe')
                ->where('pe.askedBy = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getResult()
            ;
    }

    /**
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countArrival(): int
    {
        return
            $queryBuilder = $this->createQueryBuilder('pe')
            ->select('COUNT(pe)')
            ->where('pe.processed = 0')
            ->getQuery()
            ->getSingleScalarResult()
        ;

    }

    /**
     * for a given user count all arrivals validations requests asked inside warehouses he has access to
     *
     * @param int $id
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countArrivalInUserWarehouse(int $id): int
    {
        return
            $queryBuilder = $this->createQueryBuilder('pe')
            ->select('COUNT(pe)')
            ->innerJoin('App\Entity\UserInWarehouse',
                'userInWarehouse',
                \Doctrine\ORM\Query\Expr\Join::WITH,
                'pe.warehouse = userInWarehouse.warehouse')
            ->andwhere('userInWarehouse.user = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}