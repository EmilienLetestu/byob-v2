<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 25/08/2018
 * Time: 16:56
 */

namespace App\DTO;


use App\Entity\Product;
use App\Entity\Warehouse;

class OrderPreparationDTO
{

    /**
     * @var array
     */
    private  $warehouseName = [];

    /**
     * @var array
     */
    private  $stock = [];

    /**
     * @var array
     */
    private  $products = [];

    /**
     * @var array
     */
    private  $missing = [];

    /**
     * @var array
     */
    private  $matchingWarehouses = [];

    /**
     * @var array
     */
    protected  $productId  = [];

    /**
     * @var array
     */
    private  $quantities = [];

    /**
     * @var array
     */
    private $productModel = [];


    /**
     * @param array $matchingWarehouse
     */
    public function setMatchingWarehouses(?Warehouse $matchingWarehouse): void
    {
        $this->matchingWarehouses[] = $matchingWarehouse;
    }

    /**
     * @param array $missingProduct
     */
    public function setMissing(array $missingProduct): void
    {
        $this->missing[] = $missingProduct;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId[] = $productId;
    }

    /**
     * @param int $warehouseId
     * @param Warehouse $warehouse
     */
    public function setWarehouseName(int $warehouseId, Warehouse $warehouse): void
    {
        $this->warehouseName[$warehouseId] = $warehouse;
    }

    /**
     * @param int $warehouseId
     */
    public function setStock(int $warehouseId): void
    {
        $this->stock[] = $warehouseId;
    }

    /**
     * @param int $prodId
     * @param int $quantity
     */
    public function setQuantities(int $prodId, int $quantity): void
    {
        $this->quantities[$prodId] = $quantity;
    }

    /**
     * @param int $prodId
     */
    public function setProducts(int $prodId): void
    {
        $this->products[] = $prodId;
    }

    public function setProductModel(int $prodId, Product $product): void
    {
        $productModel[$prodId] = $product;
    }


    /**
     * @return array
     */
    public function getMatchingWarehouses(): array
    {
        return $this->matchingWarehouses;
    }

    /**
     * @return array
     */
    public function getWarehouseName(): array
    {
        return $this->warehouseName;
    }

    /**
     * @return array
     */
    public function getMissing(): array
    {
        return $this->missing;
    }

    /**
     * @return array
     */
    public function getProductId(): array
    {
        return $this->productId;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @return array
     */
    public function getQuantities(): array
    {
        return $this->quantities;
    }

    /**
     * @return array
     */
    public function getStock(): array
    {
        return $this->stock;
    }

    /**
     * @return array
     */
    public function getProductModel(): array
    {
        return $this->productModel;
    }

}