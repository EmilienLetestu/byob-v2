<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 10:45
 */

namespace App\Repository;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\Product;
use Doctrine\ORM\Query\Expr;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ProductRepository extends ServiceEntityRepository
{
    /**
     * ProductRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @return array
     */
    public function findAllProduct(): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('pr')
            ->select('pr')
            ->orderBy('pr.model', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param int $id
     * @return null|Product
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findProductWithId(int $id):? Product
    {
        return
            $queryBuilder = $this->createQueryBuilder('pr')
            ->where('pr.id = :id' )
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}