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

    /**
     * @param int $id
     * @return Orders
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOrderWithId(int $id): Orders
    {
        return
            $queryBuilder = $this->createQueryBuilder('o')
            ->where('o.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param int $id
     * @return array
     */
    public function findAllOrderWithUser(int $id): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('o')
            ->where('o.orderedBy = :id')
            ->setParameter('id', $id)
            ->orderBy('o.orderedOn', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param string $status
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countOrderWithStatus(string $status):int
    {
        return
            $queryBuilder = $this->createQueryBuilder('o')
            ->select('COUNT(o)')
            ->where('o.status = :status')
            ->setParameter('status', strtolower($status))
            ->getQuery()
            ->getSingleScalarResult()
         ;
    }

    /**
     * @return array
     */
    public function findOrderForAccountant(): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('o')
            ->where("o.status = 'en attente de paiement' ")
            ->orWhere("o.status = 'en attente de validation' ")
            ->getQuery()
            ->getResult()
        ;

    }
}