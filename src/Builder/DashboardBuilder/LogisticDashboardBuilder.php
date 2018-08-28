<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 28/08/2018
 * Time: 21:22
 */

namespace App\Builder\DashboardBuilder;


use App\Builder\Interfaces\DashboardBuilderInterface;
use App\Entity\BackOrder;
use App\Entity\Orders;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class LogisticDashboardBuilder implements DashboardBuilderInterface
{
    /**
     * @var AdminDashboard
     */
    private $dashboard;

    /**
     * @var EntityManagerInterface
     */
    private $doctrine;


    /**
     * LogisticDashboardBuilder constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(
        EntityManagerInterface $doctrine

    )
    {
        $this->doctrine = $doctrine;
        $this->dashboard = new LogisticDashboard();
    }

    public function addDataMonitoring()
    {

        $this->dashboard->setData('total livreurs',
            $this->doctrine->getRepository(User::class)->countUserWithRole('DELIVERYMAN')
        );
        $this->dashboard->setData('commandes à livrer',
            $this->doctrine->getRepository(Orders::class)->countOrderWithStatus('en attente d\'enlèvement')
        );
        $this->dashboard->setData('reliquat à livrer',
            $this->doctrine->getRepository(BackOrder::class)->countAllToDeliver()
        );

    }

    public function createDashBoard()
    {
        $this->dashboard;
    }

    /**
     * @return SalesmanDashboard
     */
    public function getDashboard(): LogisticDashboard
    {
        return $this->dashboard;
    }
}