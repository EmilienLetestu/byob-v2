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
     * @param $id
     * @return array
     */
    public function findAllPendingFromWarehouse($id): array
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
}