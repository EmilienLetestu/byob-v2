<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 25/08/2018
 * Time: 14:33
 */

namespace App\Services;

use App\DTO\OrderPreparationDTO;
use App\Entity\InOrderProduct;
use App\Entity\InStockProduct;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class OrderPreparation
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * @var
     */
    private $session;

    /**
     * OrderPreparation constructor.
     * @param EntityManagerInterface $doctrine
     * @param SessionInterface $session
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        SessionInterface       $session
    )
    {
        $this->doctrine = $doctrine;
        $this->session  = $session;
    }

    /**
     * @param int $orderId
     * @param OrderPreparationDTO $dto
     */
    public function getAllInOrderAndInitializeSearch(int $orderId, OrderPreparationDTO $dto)
    {
        $inOrders = $this->doctrine
            ->getRepository(InOrderProduct::class)
            ->findAllWithOrder($orderId)
        ;

        $this->session->set('inOrder', $inOrders);

        foreach ($inOrders as $inOrder)
        {
            $dto->setProductId(
                $inOrder->getProduct()->getId()
            );

            $dto->setQuantities(
                $inOrder->getProduct()->getId(),$inOrder->getQuantity()
            );
        }
    }

    /**
     * @param array $productId
     * @param $orderId
     * @return mixed
     */
    public function getStocksMatchingOrderedQuantities(array $productId, $orderId): array
    {
        return
            $this->doctrine
            ->getRepository(InStockProduct::class)
            ->findWithProductAndAtLeast($productId, $orderId);
    }

    /**
     * @param array $inStocks
     * @param OrderPreparationDTO $dto
     * @return OrderPreparationDTO
     */
    private function setOrderedContent(array $inStocks, OrderPreparationDTO $dto)
    {

        foreach ($inStocks as $key => $inStock)
        {
            $dto->setStock(
                $inStock->getWarehouse()->getId()
            );
            $dto->setWarehouseName(
                $inStock->getWarehouse()->getId(),$inStock->getWarehouse()
            );
            $dto->setProducts(
                $inStock->getProduct()->getId()
            );
            $dto->setProductModel(
                $inStock->getProduct()->getId(),$inStock->getProduct()
            );
        }

        return $dto;

    }

    /**
     * @param OrderPreparationDTO $dto
     */
    private function getMatchingWarehouseForOrder(OrderPreparationDTO $dto)
    {

        $warehouse = array_count_values($dto->getStock());

        if(in_array(count($dto->getProductId()), $warehouse))
        {
            $r[] = array_search(count($dto->getProductId()), $warehouse);
            foreach ($r as $key=>$value)
            {
                $warehouseName = $dto->getWarehouseName();
                $dto->setMatchingWarehouses($warehouseName[$value]);
            }
        }
    }

    /**
     * @param OrderPreparationDTO $dto
     */
    private function checkForMissingProduct(OrderPreparationDTO $dto)
    {
        $quantities = $dto->getQuantities();

        $repo = $this->doctrine
            ->getRepository(InStockProduct::class)
        ;

        foreach ($dto->getProductId() as $id)
        {
            if(!array_key_exists($id, $dto->getProductModel()))
            {
                $dto->setMissing(
                    $repo->findWithStockedProduct($id, $quantities[$id])
                );
            }
        }
    }

    /**
     * @param array $productId
     * @param $orderId
     * @return array
     */
    private function getStockMatchingProduct(array $productId, $orderId): array
    {
        return
            $this->doctrine
                ->getRepository(InStockProduct::class)
                ->findWithProductOrdered($productId, $orderId)
        ;

    }

    /**
     * @param array $inStocks
     * @param OrderPreparationDTO $dto
     * @param int $orderId
     */
    public function getBestSolutions(array $inStocks, OrderPreparationDTO $dto, int $orderId)
    {
        if(count($inStocks) > 0)
        {
            $orderedContent = $this->setOrderedContent($inStocks, $dto);

            $this->getMatchingWarehouseForOrder($dto);

            $prod = array_count_values($orderedContent->getProducts());


            if(count($prod) < count($dto->getProductId()))
            {
                $this->checkForMissingProduct($dto);
            }

        }else{

            $dto->setMissing(
                $this->getStockMatchingProduct(
                    $dto->getProductId(),$orderId
                )
            );
        }

        $this->session->set('inOrderDto', $dto);
    }


}

