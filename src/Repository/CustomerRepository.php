<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 07/08/2018
 * Time: 21:22
 */

namespace App\Repository;


use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CustomerRepository extends ServiceEntityRepository
{
    /***
     * CustomerRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    /**
     * @return array
     */
    public function findAllCustomer(): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('cu')
            ->select('cu')
            ->orderBy('cu.company', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param int $id
     * @return Customer
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findCustomerWithId(int $id): Customer
    {
        return
            $queryBuilder = $this->createQueryBuilder('cu')
            ->where('cu.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param int $id
     * @return array
     */
    public function findUserCustomer(int $id): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('cu')
            ->select('cu')
            ->innerJoin(
                'App\Entity\Orders',
                'o',
                \Doctrine\ORM\Query\Expr\Join::WITH,
                'cu.id = o.customer'
                )
            ->andWhere('o.orderedBy = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countCustomer(): int
    {
        return
            $queryBuilder = $this->createQueryBuilder('cu')
                ->select('COUNT(cu)')
                ->getQuery()
                ->getSingleScalarResult()
            ;
    }

    /**
     * @param int $id
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countUserCustomer(int $id): int
    {
        return
            $queryBuilder = $this->createQueryBuilder('cu')
                ->select('COUNT(cu)')
                ->innerJoin(
                    'App\Entity\Orders',
                    'o',
                    \Doctrine\ORM\Query\Expr\Join::WITH,
                    'cu.id = o.customer'
                )
                ->andWhere('o.orderedBy = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getSingleScalarResult()
            ;
    }

}
