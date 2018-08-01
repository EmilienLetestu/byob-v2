<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 23:09
 */

namespace App\Repository;


use App\Entity\Warehouse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class WarehouseRepository extends ServiceEntityRepository
{
    /**
     * ProductRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Warehouse::class);
    }

    /**
     * @return array
     */
    public function findAllWarehouse(): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('w')
                ->select('w')
                ->orderBy('w.name', 'ASC')
                ->getQuery()
                ->getResult()
            ;
    }
}