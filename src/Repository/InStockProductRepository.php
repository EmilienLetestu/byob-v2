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

    /**
     * @return array
     */
    public function findAllDistinctProduct(): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('inStock')
            ->select('inStock')
            ->distinct('product')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param int $id
     * @param int $quantity
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findWithProductAndAtLeast(int $id, int $quantity):? InStockProduct
    {
        return
            $queryBuilder = $this->createQueryBuilder('inStock')
            ->where('inStock.product = :id')
            ->andWhere('inStock.level >=  :quantity')
            ->setParameter('id', $id)
            ->setParameter('quantity', $quantity)
            ->orderBy('inStock.level', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}