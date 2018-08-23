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
use Doctrine\ORM\Query\Expr;
use Symfony\Bridge\Doctrine\RegistryInterface;
use function Symfony\Component\DependencyInjection\Loader\Configurator\expr;

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
     * @param int $warehouseId
     * @return array
     */
    public function findStockInWareHouse(int $warehouseId): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('inStock')
            ->where('inStock.warehouse = :warehouseId')
            ->setParameter('warehouseId', $warehouseId)
            ->getQuery()
            ->getResult()
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
     * @param array $ids
     * @param int $orderId
     * @return mixed
     */
    public function findWithProductAndAtLeast(array $ids, int $orderId): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('inStock')
            ->select('inStock')
            ->innerJoin('App\Entity\InOrderProduct',
                    'inOrder',
                    \Doctrine\ORM\Query\Expr\Join::WITH,
                    'inStock.product = inOrder.product')
            ->andWhere('inOrder.order = :orderId')
            ->andWhere('inOrder.product IN (:ids)')
            ->andWhere('inOrder.quantity <= inStock.level')
            ->addOrderBy('inStock.product')
            ->addOrderBy('inStock.level','DESC')
            ->setParameter('ids', $ids)
            ->setParameter('orderId', $orderId)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param array $ids
     * @param int $orderId
     * @return mixed
     */
    public function findWithProductOrdered(array $ids, int $orderId): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('inStock')
                ->select('inStock')
                ->innerJoin('App\Entity\InOrderProduct',
                    'inOrder',
                    \Doctrine\ORM\Query\Expr\Join::WITH,
                    'inStock.product = inOrder.product')
                ->andWhere('inOrder.order = :orderId')
                ->andWhere('inOrder.product IN (:ids)')
                ->addOrderBy('inStock.product')
                ->addOrderBy('inStock.level','DESC')
                ->setParameter('ids', $ids)
                ->setParameter('orderId', $orderId)
                ->getQuery()
                ->getResult()
            ;
    }

    /**
     * @param int $id
     * @param int $quantity
     * @return array
     */
    public function findWithStockedProduct(int $id, int $quantity): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('inStock')
                ->select('inStock')
                ->where('inStock.product = :id')
                ->andWhere('inStock.level < :quantity')
                ->addOrderBy('inStock.level','DESC')
                ->setParameter('id', $id)
                ->setParameter('quantity', $quantity)
                ->getQuery()
                ->getResult()
            ;
    }

    /**
     * @param array $ids
     * @param int $warehouse
     * @return array
     */
    public function findStockToBind(array $ids, int $warehouse): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('inStock')
            ->where('inStock.product In (:ids)')
            ->andWhere('inStock.warehouse = :warehouse')
            ->setParameter('ids', $ids)
            ->setParameter('warehouse', $warehouse)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return array
     */
    public function findAllWithAlert(): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('inStock')
            ->where('inStock.alertLevel >= inStock.level')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countWithAlert(): int
    {
        return
            $queryBuilder = $this->createQueryBuilder('inStock')
            ->select('COUNT(inStock)')
            ->where('inStock.alertLevel >= inStock.level')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}
