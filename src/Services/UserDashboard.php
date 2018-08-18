<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 14/08/2018
 * Time: 09:33
 */

namespace App\Services;


use App\Builder\DashboardBuilder\AccountantDashboardBuilder;
use App\Builder\DashboardBuilder\AdminDashboardBuilder;
use App\Builder\DashboardBuilder\DashboardBuilder;
use App\Builder\DashboardBuilder\SalesmanDashboardBuilder;
use App\Builder\DashboardBuilder\WarehousemanDashboardBuilder;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserDashboard
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * @var DashboardBuilder
     */
    private $builder;


    /**
     * UserDashboard constructor.
     * @param EntityManagerInterface $doctrine
     * @param DashboardBuilder $builder
     * @param TokenStorageInterface $token
     */
    public function __construct(
        EntityManagerInterface        $doctrine,
        DashboardBuilder              $builder


    )
    {
        $this->doctrine = $doctrine;
        $this->builder   = $builder;
    }

    /**
     * @param TokenStorage $token
     * @return array
     */
    public function getUserDashboard(TokenStorage $token): array
    {
        switch ($token->getToken()->getUser()->getRole()):
            case 'ADMIN':
                return $this->builder->build(
                    new AdminDashboardBuilder($this->doctrine))->getData();
                break;

            case 'WAREHOUSEMAN':
                return $this->builder->build(
                    new WarehousemanDashboardBuilder($this->doctrine, $token))->getData();
                break;


            case 'SALESMAN':
                return $this->builder->build(
                    new SalesmanDashboardBuilder($this->doctrine, $token))->getData();
                break;

            case 'ACCOUNTANT':
                return $this->builder->build(
                    new AccountantDashboardBuilder($this->doctrine, $token))->getData();
                break;

        endswitch;
    }
}

