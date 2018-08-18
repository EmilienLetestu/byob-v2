<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 18/08/2018
 * Time: 18:02
 */

namespace App\Builder\DashboardBuilder;


use App\Builder\Interfaces\DashboardBuilderInterface;
use App\Entity\Customer;
use App\Entity\Orders;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SalesmanDashboardBuilder implements DashboardBuilderInterface
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
     * @var TokenStorageInterface
     */
    private $token;

    /**
     * SalesmanDashboardBuilder constructor.
     * @param EntityManagerInterface $doctrine
     * @param TokenStorageInterface $token
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        TokenStorageInterface  $token

    )
    {
        $this->doctrine = $doctrine;
        $this->dashboard = new SalesmanDashboard();
        $this->token     = $token;
    }

    public function addDataMonitoring()
    {

        $this->dashboard->setData('total clients',
            $this->doctrine->getRepository(Customer::class)->countCustomer()
        );
        $this->dashboard->setData('produits référencés',
            $this->doctrine->getRepository(Product::class)->countProduct()
        );
        $this->dashboard->setData('mes clients',
            $this->doctrine->getRepository(Customer::class)->countUserCustomer($this->getId())
        );
        $this->dashboard->setData('mes commandes',
            $this->doctrine->getRepository(Orders::class)->countArrival($this->getId())
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
     * @return SalesmanDashboard
     */
    public function getDashboard(): SalesmanDashboard
    {
        return $this->dashboard;
    }

    /**
     * @return mixed
     */
    private function getId(): int
    {
        return
            $this->token->getToken()->getUser()->getId();
    }
}