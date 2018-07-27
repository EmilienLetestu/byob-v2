<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 27/07/2018
 * Time: 13:50
 */

namespace App\Entity;

/**
 * where all referenced product are "turned" into stock with a level and a level alert
 * where for a given product we will calculate and adjust the flows
 * where we will keep track of the flows
 *
 * Class InStockProduct
 * @package App\Entity
 */
class InStockProduct
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $level = null;

    /**
     * @var
     */
    private $alertLevel;

    /**
     * @var
     */
    private $product;

    /**
     * @param int $level
     */
    public function setLevel(?int $level): void
    {
        $this->level = $level;
    }

    /**
     * @param mixed $alertLevel
     */
    public function setAlertLevel($alertLevel): void
    {
        $this->alertLevel = $alertLevel;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getLevel():? int
    {
        return $this->level;
    }

    /**
     * @return int
     */
    public function getAlertLevel(): int
    {
        return $this->alertLevel;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

}