<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 28/08/2018
 * Time: 19:16
 */

namespace App\Services;


use App\Repository\InOrderProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PreparationList
{
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * PreparationList constructor.
     * @param SessionInterface $session
     */
    public function __construct(
        SessionInterface       $session
    )
    {
        $this->session  = $session;
    }

    /**
     * @param InOrderProductRepository $repo
     * @param int $warehouseId
     * @param int $id
     * @return array
     */
    public function regularOrderList(InOrderProductRepository $repo,int $warehouseId, int $id): array
    {
        return
                $repo->findReadyToPrepareInWarehouse(
                $warehouseId,
                $id,
                'en préparation'
        );
    }

    /**
     * @param InOrderProductRepository $repo
     * @param int $warehouseId
     * @param int $id
     * @return array
     */
    public function backOrderList(InOrderProductRepository $repo,int $warehouseId, int $id): array
    {
        $backOrders = $repo->findBackOrderDetail($warehouseId, $id);

        $this->session->set('backOrders', $backOrders);

        return $backOrders;
    }


}