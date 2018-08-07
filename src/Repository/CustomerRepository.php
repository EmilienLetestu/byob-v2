<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 07/08/2018
 * Time: 21:22
 */

namespace App\Repository;


use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CustomerRepository extends ServiceEntityRepository
{
    /***
     * CustomerRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    /**
     * @return array
     */
    public function findAllCustomer(): array
    {
        return
            $queryBuilder = $this->createQueryBuilder('cu')
            ->select('cu')
            ->orderBy('cu.company', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}