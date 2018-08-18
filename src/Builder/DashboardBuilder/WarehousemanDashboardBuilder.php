<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 18/08/2018
 * Time: 17:49
 */

namespace App\Builder\DashboardBuilder;


use App\Builder\Interfaces\DashboardBuilderInterface;
use App\Entity\PendingValidationStock;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class WarehousemanDashboardBuilder implements DashboardBuilderInterface
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
     * warehousemanDashboardBuilder constructor.
     * @param EntityManagerInterface $doctrine
     * @param TokenStorageInterface $token
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        TokenStorageInterface $token

    )
    {
        $this->doctrine  = $doctrine;
        $this->dashboard = new WarehousemanDashboard();
        $this->token     = $token;
    }


    public function addDataMonitoring()
    {
        $this->dashboard->setData('mes arrivages traités' ,
            $this->doctrine->getRepository(PendingValidationStock::class)
                ->countUserArrivalWithStatus($this->getId(), true)
        );
        $this->dashboard->setData('mes arrivages en attentes de validations',
            $this->doctrine->getRepository(PendingValidationStock::class)
                ->countUserArrivalWithStatus($this->getId(), false)
        );

    }


    public function createDashBoard()
    {
        $this->dashboard;
    }

    /**
     * @return WarehousemanDashboard
     */
    public function getDashboard(): WarehousemanDashboard
    {
        return $this->dashboard;
    }

    /**
     * @return int
     */
    private function getId(): int
    {
        return
            $this->token->getToken()->getUser()->getId()
        ;
    }

}