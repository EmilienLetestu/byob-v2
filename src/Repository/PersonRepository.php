<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 13/08/2018
 * Time: 10:25
 */

namespace App\Repository;


use App\Entity\Person;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PersonRepository extends ServiceEntityRepository
{
    /**
     * PersonRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Person::class);
    }

    /**
     * @param int $id
     * @return Person|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findPersonWithId(int $id):? Person
    {
        return
            $queryBuilder = $this->createQueryBuilder('per')
            ->where('per.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}