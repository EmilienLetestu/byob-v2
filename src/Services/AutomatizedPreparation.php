<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 25/08/2018
 * Time: 23:56
 */

namespace App\Services;


use App\DTO\OrderPreparationDTO;
use App\Entity\InStockProduct;
use Doctrine\ORM\EntityManagerInterface;

class AutomatizedPreparation
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * AutomatizedPreparation constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param array $inOrders
     * @param OrderPreparationDTO $dto
     * @param int $warehouseId
     */
    public function assignToStock(array $inOrders, OrderPreparationDTO $dto, int $warehouseId)
    {

        foreach ($inOrders as $inOrder)
        {
            $order = $this->doctrine
                ->merge($inOrder->getOrder()
            );
        }

        $order->setStatus('en préparation');


        $inStocks = $this->doctrine
            ->getRepository(InStockProduct::class)
            ->findStockToBind($dto->getProductId(), $warehouseId)
        ;

        foreach ($inOrders as $inOrder)
        {
            $reactivateInOrder = $this->doctrine->merge($inOrder);
            $reactivateInOrder->setWarehouse($inStocks[0]->getWarehouse());
        }

        $quantities = $dto->getQuantities();

        foreach($inStocks as $inStock)
        {
            $inStock->setLevel(
                $inStock->getLevel() - $quantities[$inStock->getProduct()->getId()]
            );
        }

        $this->doctrine->flush();
    }
}