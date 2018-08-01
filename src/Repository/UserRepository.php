<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 22:24
 */

namespace App\Repository;


use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository
{
    /**
     * ProductRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @return array
     */
    public function findAllUser(): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('u')
                ->select('u')
                ->orderBy('u.name', 'ASC')
                ->getQuery()
                ->getResult()
            ;
    }
}