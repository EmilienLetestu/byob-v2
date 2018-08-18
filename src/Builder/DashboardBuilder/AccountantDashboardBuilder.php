<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 18/08/2018
 * Time: 18:22
 */

namespace App\Builder\DashboardBuilder;


use App\Builder\Interfaces\DashboardBuilderInterface;
use App\Entity\Orders;
use App\Entity\PendingValidationStock;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AccountantDashboardBuilder implements DashboardBuilderInterface
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
        $this->dashboard = new AccountantDashboard();
        $this->token     = $token;
    }


    public function addDataMonitoring()
    {
        $this->dashboard->setData('arrivages à valider' ,
            $this->doctrine->getRepository(PendingValidationStock::class)
                ->countArrivalInUserWarehouse($this->getId())
        );
        $this->dashboard->setData('commandes non payées',
           $this->doctrine->getRepository(Orders::class)
               ->countOrderWithStatus('en attente de paiement')

        );
        $this->dashboard->setData('commandes à valider',
            $this->doctrine->getRepository(Orders::class)
                ->countOrderWithStatus('en attente de validation')

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
     * @return AccountantDashboard
     */
    public function getDashboard(): AccountantDashboard
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