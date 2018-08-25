<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 25/08/2018
 * Time: 21:24
 */

namespace App\Services;


use App\DTO\OrderPreparationDTO;
use App\Entity\InStockProduct;
use Doctrine\ORM\EntityManagerInterface;

class ManuallyPreparedOrder
{

    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * ManuallyPreparedOrder constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param array $inOrders
     * @param OrderPreparationDTO $dto
     * @param string $urlData
     */
    public function assignToStock(array $inOrders, OrderPreparationDTO $dto, string $urlData)
    {
        $quantities = $dto->getQuantities();

        foreach ($inOrders as $inOrder)
        {
            $order = $this->doctrine->merge($inOrder->getOrder());
            $reactivateInOrder = $this->doctrine->merge($inOrder);
            $ordered[$inOrder->getProduct()->getId()] = $reactivateInOrder;

        }

        $order->setStatus('en préparation');


        $data = explode('&',$urlData);

        $products = [];

        foreach ($data as $key => $value)
        {
            $productAndWarehouse = explode('_',$value);

            $products[$productAndWarehouse[0]] = $productAndWarehouse[1] ;
        }

        $inStock =  $this->doctrine
            ->getRepository(InStockProduct::class)
        ;


        foreach ($products as $key=>$value)
        {
            $prodId      = str_replace('p'," ",$key);
            $warehouseId = str_replace('w'," ",$value);
            $stock = $inStock->findProductStockInWarehouse(intval($prodId), intval($warehouseId));

            $stock->setLevel(
                $stock->getLevel() - $quantities[$stock->getProduct()->getId()]
            );

            $ordered[$stock->getProduct()->getId()]->setWarehouse($stock->getWarehouse());
        }

        $this->doctrine->flush();

    }
}