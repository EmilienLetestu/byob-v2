<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 28/08/2018
 * Time: 10:01
 */

namespace App\Services;


use App\Entity\User;
use App\Repository\OrdersRepository;

class OrderListForRole
{
    public function getOrderListForRole(OrdersRepository $repo, User $user)
    {
        $warehouse = $user->getUserInWarehouses();

        switch ($user->getRole()):
            case 'ADMIN':
                return $repo->findAllOrder();
                break;
            case 'SALESMAN':
                return $repo->findAllorderWithUser($user->getId());
                break;
            case 'ACCOUNTANT':
                return $repo->findOrderWithStatus('en attente de validation');
                break;
            case 'SUPPLY':
                return $repo->findOrderWithStatus('payé et validé');
                break;
            case 'WAREHOUSEMAN':
                return $repo->findToPrepareInWarehouse($warehouse[0]->getWarehouse()->getId(), 'en préparation');

            case 'LOGISTIC':
                return $repo->findOrderWithStatus('en attente d\'attribution');
                break;
            case 'DELIVERYMAN':
                return $repo->findOrderForDeliveryMan('en attente d\'enlèvement');
                break;
        endswitch;
    }


}