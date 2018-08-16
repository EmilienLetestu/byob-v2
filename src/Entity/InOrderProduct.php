<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 27/07/2018
 * Time: 13:49
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class InOrderProduct
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $quantity;

    /**
     * @var
     */
    private $product;

    /**
     * @var
     */
    private $order;

    /**
     * @var
     */
    private $warehouse;


    /**
     * @param int $quantity
     */
    public  function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @param Orders $order
     */
    public function setOrder(Orders $order): void
    {
        $this->order = $order;
    }

    /**
     * @param Warehouse|null $warehouse
     */
    public function setWarehouse(?Warehouse $warehouse): void
    {
        $this->warehouse = $warehouse;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return Orders
     */
    public function getOrder(): Orders
    {
        return $this->order;
    }

    /**
     * @return Warehouse|null
     */
    public function getWarehouse():? Warehouse
    {
        return $this->warehouse;
    }
}
