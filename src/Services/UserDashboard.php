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
     * @return array
     */
    public function getUserDashboard(string $role)
    {
        switch ($role):
            case 'ADMIN':
                return $this->adminDashboard();
                break;

            case 'SALESMAN':
                return $this->salesmanDashbaord();
                break;

            default:
               return $this->adminDashboard();
        endswitch;
    }

    /**
     * @return array
     */
    private function adminDashboard()
    {
        return [
          'total utilisateur'  =>  $this->doctrine->getRepository(User::class)->findAllUser(),
          'toltal client'      =>  $this->doctrine->getRepository(Customer::class)->findAllCustomer(),
          'total commande'     =>  $this->doctrine->getRepository(Orders::class)->findAllOrder(),
          'produits référencés'=>  $this->doctrine->getRepository(Product::class)->findAllProduct(),
          'en alerte'          =>  $this->doctrine->getRepository(InStockProduct::class)->findAllWithAlert(),
          'arrivages'          =>  $this->doctrine->getRepository(PendingValidationStock::class)->findAllArrival(),
          'entrepôts'          =>  $this->doctrine->getRepository(Warehouse::class)->findAllWarehouse()
        ];

    }
}