<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 22/09/2018
 * Time: 18:53
 */

namespace App\Builder\DashboardBuilder;


use App\Builder\Interfaces\DashboardBuilderInterface;
use App\Entity\BackOrder;
use App\Entity\Orders;
use Doctrine\ORM\EntityManagerInterface;

class DeliverymanDashboardBuilder implements DashboardBuilderInterface
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
        $this->dashboard = new DeliverymanDashboard();
    }

    public function addDataMonitoring()
    {

        $this->dashboard->setData('commandes à livrer',
            $this->doctrine->getRepository(Orders::class)->countOrderWithStatus('en attente d\'enlèvement')
        );
        $this->dashboard->setData('reliquats à livrer',
            $this->doctrine->getRepository(BackOrder::class)->countAllToDeliver()
        );

    }

    public function createDashBoard()
    {
        $this->dashboard;
    }

    /**
     * @return DeliverymanDashboard
     */
    public function getDashboard(): DeliverymanDashboard
    {
        return $this->dashboard;
    }
}