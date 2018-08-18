<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 18/08/2018
 * Time: 16:15
 */

namespace App\Builder\DashboardBuilder;


use App\Builder\Interfaces\DashboardBuilderInterface;
use App\Entity\Customer;
use App\Entity\InStockProduct;
use App\Entity\Orders;
use App\Entity\PendingValidationStock;
use App\Entity\Product;
use App\Entity\User;
use App\Entity\Warehouse;
use Doctrine\ORM\EntityManagerInterface;

class AdminDashboardBuilder implements DashboardBuilderInterface
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
     * AdminDashboardBuilder constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(
        EntityManagerInterface $doctrine

    )
    {
        $this->doctrine = $doctrine;
        $this->dashboard = new AdminDashboard();
    }

    public function addDataMonitoring()
    {
        $this->dashboard->setData('total utilisateur' ,
            $this->doctrine->getRepository(User::class)->countUser()
        );
        $this->dashboard->setData('total client',
            $this->doctrine->getRepository(Customer::class)->countCustomer()
        );
        $this->dashboard->setData('total commande',
            $this->doctrine->getRepository(Orders::class)->countOrderWithStatus('en attente de livraison')
        );
        $this->dashboard->setData('produits référencés',
            $this->doctrine->getRepository(Product::class)->countProduct()
        );
        $this->dashboard->setData('en alerte',
            $this->doctrine->getRepository(InStockProduct::class)->countWithAlert()
        );
        $this->dashboard->setData('arrivages',
            $this->doctrine->getRepository(PendingValidationStock::class)->countArrival()
        );
        $this->dashboard->setData('entrepôts',
            $this->doctrine->getRepository(Warehouse::class)->countWarehouse()
        );

    }

    public function addAlias()
    {
        // TODO: Implement addAlias() method.
    }

    public function createDashBoard()
    {
        $this->dashboard;
    }

    /**
     * @return AdminDashboard
     */
    public function getDashboard(): AdminDashboard
    {
       return $this->dashboard;
    }
}