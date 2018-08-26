<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 26/08/2018
 * Time: 18:27
 */

namespace App\Repository;


use App\Entity\BackOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class BackOrderRepository extends ServiceEntityRepository
{
    /***
     * CustomerRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BackOrder::class);
    }
}