<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 12/08/2018
 * Time: 12:32
 */

namespace App\Repository;


use App\Entity\RefMaster;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class RefMasterRepository extends ServiceEntityRepository
{
    /**
     * RefMasterRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RefMaster::class);
    }


    /**
     * @param string $name
     * @return RefMaster|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findRefWithName(string $name):? RefMaster
    {
        return
            $queryBuilder = $this->createQueryBuilder('refM')
                ->where('refM.name = :name')
                ->setParameter('name', $name)
                ->getQuery()
                ->getOneOrNullResult()
        ;
    }
}