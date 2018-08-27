<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 23:40
 */

namespace App\Repository;


use App\Entity\InOrderProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class InOrderProductRepository extends ServiceEntityRepository
{
    /**
     * InOrderProductRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InOrderProduct::class);
    }

    /**
     * @param int $orderId
     * @return array
     */
    public function findAllWithOrder(int $orderId): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('inOrder')
            ->where('inOrder.order = :orderId')
            ->setParameter('orderId', $orderId)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param int $warehouseId
     * @param int $quantity
     * @param int $productId
     * @return array
     */
    public function findAllWithBackOrderAndWarehouse(int $warehouseId, int $quantity, int $productId): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('inOrder')
                ->select('inOrder')
                ->join('App\Entity\BackOrder', 'b')
                ->andWhere('inOrder.backOrder IS NOT NULL')
                ->andWhere('inOrder.product = :productId')
                ->andwhere('inOrder.warehouse = :warehouseId')
                ->andWhere('inOrder.quantity < :quantity')
                ->andWhere('b.regularize = 0')
                ->orderBy('b.since','DESC')
                ->setParameter('warehouseId', $warehouseId)
                ->setParameter('quantity', $quantity)
                ->setParameter('productId', $productId)
                ->getQuery()
                ->getResult()
            ;
    }

    /**
     * @param int $warehouseId
     * @param int $orderId
     * @param string $status
     * @return array
     */
    public function findReadyToPrepareInWarehouse(int $warehouseId, int $orderId, string $status): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('inOrder')
                ->select( 'inOrder')
                ->join('App\Entity\Orders', 'o',\Doctrine\ORM\Query\Expr\Join::WITH, 'inOrder.order = o.id' )
                ->andWhere('inOrder.backOrder IS NULL')
                ->andWhere('o.id = :orderId')
                ->andWhere('o.status = :status')
                ->andwhere('inOrder.warehouse = :warehouseId')
                ->setParameter('warehouseId', $warehouseId)
                ->setParameter('orderId', $orderId)
                ->setParameter('status', $status)
                ->getQuery()
                ->getResult()
            ;
    }

    /**
     * @param int $warehouseId
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countBackOrderToPrepare(int $warehouseId): int
    {
        return
            $queryBuilder = $this->createQueryBuilder('inOrder')
                ->select('COUNT(inOrder)')
                ->join('App\Entity\BackOrder', 'b')
                ->andWhere('inOrder.backOrder IS NOT NULL')
                ->andwhere('inOrder.warehouse = :warehouseId')
                ->andWhere('b.regularize = 0')
                ->setParameter('warehouseId', $warehouseId)
                ->getQuery()
                ->getSingleScalarResult()
            ;
    }
}