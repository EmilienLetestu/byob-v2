<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 14/08/2018
 * Time: 09:33
 */

namespace App\Services;


use App\Entity\Customer;
use App\Entity\InStockProduct;
use App\Entity\Orders;
use App\Entity\PendingValidationStock;
use App\Entity\Product;
use App\Entity\User;
use App\Entity\Warehouse;

use Doctrine\ORM\EntityManagerInterface;

class UserDashboard
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * UserDashboard constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(
        EntityManagerInterface $doctrine
    )
    {
        $this->doctrine = $doctrine;
    }


    /**
     * @param string $role
     * @param int $id
     * @return array
     */
    public function getUserDashboard(string $role, int $id)
    {
        switch ($role):
            case 'ADMIN':
                return $this->adminDashboard($id);
                break;

            case 'WAREHOUSEMAN':
                return $this->warehousemanDashboard($id);
                break;

            case 'DELIVERYMAN':
                return $this->deliverymanDashbaord();
                break;

            case 'SALESMAN':
                return $this->salesmanDashboard($id);
                break;

            case 'ACCOUNTANT':
                return $this->accountantDashboard($id);
                break;

            case 'SUPPLY':
                return $this->supplyDashbaord();
                break;

            case 'LOGISTIC':
                return $this->logisticDashbaord();
                break;

            default:
                return $this->adminDashboard();

        endswitch;
    }

    /**
     * @return array
     */
    private function adminDashboard(): array
    {
        return [
          'total utilisateur'  =>
              $this->doctrine->getRepository(User::class)->countUser(),
          'toltal client'      =>
              $this->doctrine->getRepository(Customer::class)->countCustomer(),
          'total commande'     =>
              $this->doctrine->getRepository(Orders::class)->countOrderWithStatus('en attente de livraison'),
          'produits référencés'=>
              $this->doctrine->getRepository(Product::class)->countProduct(),
          'en alerte'          =>
              $this->doctrine->getRepository(InStockProduct::class)->countWithAlert(),
          'arrivages'          =>
              $this->doctrine->getRepository(PendingValidationStock::class)->countArrival(),
          'entrepôts'          =>
              $this->doctrine->getRepository(Warehouse::class)->countWarehouse()
        ];

    }

    /**
     * @param int $id
     * @return array
     */
    private function warehousemanDashboard(int $id): array
    {
        // todo => fetch all orders to prepare
        return [
            'mes arrivages'       =>
                $this->doctrine->getRepository(PendingValidationStock::class)->findAllArrivalWithUser($id)
        ];
    }

    /**
     * @param int $id
     * @return array
     */
    private function salesmanDashboard(int $id): array
    {
        return [
            'produits référencés' =>
                $this->doctrine->getRepository(Product::class)->findAllProduct(),
            'total clients'       =>
                $this->doctrine->getRepository(Customer::class)->findAllCustomer(),
            'mes commande'        =>
                $this->doctrine->getRepository(Orders::class)->finAllOrderWithUser($id)
        ];
    }

    /**
     * @param int $id
     * @return array
     */
    private function accountantDashboard(int $id)
    {
        return [
            'arrivages à valider' => $this->doctrine
                ->getRepository(PendingValidationStock::class)->countAllArrivalInUserWarehouse($id),
            'commandes payés'     => $this->doctrine
                ->getRepository(Orders::class)->countPayedOrder(),
            'commandes non payés' => $this->doctrine
                ->getRepository(Orders::class)->countUnPayedOrder(),
            'comandes à valider'=> $this->doctrine
                ->getRepository(Orders::class)->countUnvalidatedOrder(),
        ];
    }

}