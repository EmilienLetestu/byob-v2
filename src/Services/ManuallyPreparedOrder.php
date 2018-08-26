<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 25/08/2018
 * Time: 21:24
 */

namespace App\Services;


use App\DTO\OrderPreparationDTO;
use App\Entity\BackOrder;
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

        $products = $this->getDataFromUrl($urlData);

        $inStock  = $this->doctrine
            ->getRepository(InStockProduct::class)
        ;

        foreach ($products as $key=>$value)
        {
            $prodId      = str_replace('p'," ",$key);

            $warehouseId = str_replace('w'," ",$value);

            $stock = $inStock->findProductStockInWarehouse(intval($prodId), intval($warehouseId));

            $quantity = $quantities[$stock->getProduct()->getId()];

            $stock->getLevel() >= $quantity ?
               $this->regularOrder($ordered, $stock, $quantity) :
               $this->createBackOrder($ordered, $stock)
            ;

        }

        $this->doctrine->flush();
    }

    /**
     * @param string $urlData
     * @return array
     */
    private function getDataFromUrl(string $urlData): array
    {
        $data = explode('&',$urlData);

        $products = [];

        foreach ($data as $key => $value)
        {
            $productAndWarehouse = explode('_',$value);

            $products[$productAndWarehouse[0]] = $productAndWarehouse[1] ;
        }

        return $products;
    }

    /**
     * @param array $ordered
     * @param InStockProduct $stock
     * @param int $quantity
     */
    private function regularOrder(array $ordered, InStockProduct $stock, int $quantity)
    {
        $stock->setLevel(
            $stock->getLevel() - $quantity
        );

        $ordered[$stock->getProduct()->getId()]
            ->setWarehouse($stock->getWarehouse()
       );
    }

    /**
     * @param array $ordered
     * @param InStockProduct $stock
     */
    private function createBackOrder(array $ordered, InStockProduct $stock)
    {
        $backOrder = new BackOrder();

        $backOrder->setRegularize(false);
        $backOrder->setInOrderProduct($ordered[$stock->getProduct()->getId()]);
        $backOrder->setSince('Y-m-d');

        $ordered[$stock->getProduct()->getId()]
            ->setWarehouse($stock->getWarehouse())
        ;
        $ordered[$stock->getProduct()->getId()]
            ->setBackOrder($backOrder)
        ;

        $this->doctrine->persist($backOrder);
    }
}
