<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 06/08/2018
 * Time: 23:16
 */

namespace App\Repository;


use App\Entity\InStockProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class InStockProductRepository extends ServiceEntityRepository
{
    /**
     * InStockProductRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InStockProduct::class);
    }

    /**
     * @param int $productId
     * @param int $warehouseId
     * @return InStockProduct|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findProductStockInWarehouse(int $productId, int $warehouseId):? InStockProduct
    {
        return
            $queryBuilder = $this->createQueryBuilder('inStock')
            ->where('inStock.product = :productId')
            ->andWhere('inStock.warehouse = :warehouseId')
            ->setParameter('productId', $productId)
            ->setParameter('warehouseId', $warehouseId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}