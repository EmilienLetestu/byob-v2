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
}