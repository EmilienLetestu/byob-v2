<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 28/08/2018
 * Time: 10:01
 */

namespace App\Services;


use App\Entity\User;
use Doctrine\Common\Persistence\ObjectRepository;

class OrderListForRole
{
    public function getOrderListForRole(ObjectRepository $repo, User $user)
    {
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
            case 'LOGISTIC':
                return $repo->findOrderWithStatus('en attente d\'enlèvement');
                break;
            case 'DELIVERYMAN':
                return $repo->findOrderWithStatus('en attente d\'enlèvement');
                break;
        endswitch;
    }

}