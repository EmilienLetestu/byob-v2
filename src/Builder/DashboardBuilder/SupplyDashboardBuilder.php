<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 22/08/2018
 * Time: 10:44
 */

namespace App\Builder\DashboardBuilder;


use App\Builder\Interfaces\DashboardBuilderInterface;
use App\Entity\Orders;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class SupplyDashboardBuilder implements DashboardBuilderInterface
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
     * SupplyDashboardBuilder constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(
        EntityManagerInterface $doctrine

    )
    {
        $this->doctrine  = $doctrine;
        $this->dashboard = new SupplyDashboard();
    }

    public function addDataMonitoring()
    {

        $this->dashboard->setData('produits référencés',
            $this->doctrine->getRepository(Product::class)->countProduct()
        );

        $this->dashboard->setData('commandes à préparer',
            $this->doctrine->getRepository(Orders::class)->countOrderWithStatus('payé et validé')
        );

    }

    public function createDashBoard()
    {
        $this->dashboard;
    }

    /**
     * @return SupplyDashboard
     */
    public function getDashboard(): SupplyDashboard
    {
        return $this->dashboard;
    }

}