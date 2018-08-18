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
     * @var AdminDashboardBuilder
     */
    private $admin;

    /**
     * @var WarehousemanDashboardBuilder
     */
    private $warehouseman;

    /**
     * @var SalesmanDashboardBuilder
     */
    private $salesman;

    /**
     * @var AccountantDashboardBuilder
     */
    private $accountant;


    /**
     * UserDashboard constructor.
     * @param EntityManagerInterface $doctrine
     * @param DashboardBuilder $builder
     * @param AdminDashboardBuilder $admin
     * @param WarehousemanDashboardBuilder $warehouseman
     * @param SalesmanDashboardBuilder $salesman
     * @param AccountantDashboardBuilder $accountant
     */
    public function __construct(
        EntityManagerInterface        $doctrine,
        DashboardBuilder              $builder,
        AdminDashboardBuilder         $admin,
        WarehousemanDashboardBuilder  $warehouseman,
        SalesmanDashboardBuilder      $salesman,
        AccountantDashboardBuilder    $accountant

    )
    {
        $this->doctrine = $doctrine;
        $this->builder   = $builder;
        $this->admin     = $admin;
        $this->warehouseman = $warehouseman;
        $this->salesman  = $salesman;
        $this->accountant = $accountant;
    }

    /**
     * @param string $role
     * @return \App\Builder\DashboardBuilder\Dashboard
     */
    public function getUserDashboard(string $role)
    {
        switch ($role):
            case 'ADMIN':
                return $this->builder->build($this->admin);
                break;

            case 'WAREHOUSEMAN':
                return $this->builder->build($this->warehouseman);
                break;


            case 'SALESMAN':
                return $this->builder->build($this->salesman);
                break;

            case 'ACCOUNTANT':
                return $this->builder->build($this->accountant);
                break;

        endswitch;
    }
}

