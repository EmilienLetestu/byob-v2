<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 27/07/2018
 * Time: 13:48
 */

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Will be use to save all the places where a given stock ("inStockProduct") is stored
 *
 * Class Warehouse
 * @package App\Entity
 */
class Warehouse
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $name;

    /**
     * @var
     */
    private $address;

    /**
     * @var
     */
    private $pendingValidations;

    /**
     * @var
     */
    private $inStockProducts;

    /**
     * @var
     */
    private $userInWarehouses;



    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /*----------------------- Array Collections -----------------------*/

    /**
     * Warehouse constructor.
     */
    public function __construct()
    {
        $this->pendingValidations = new ArrayCollection();
        $this->inStockProducts    = new ArrayCollection();
        $this->userInWarehouses   = new ArrayCollection();
    }

    /**
     * @param PendingValidationStock $pendingValidationStock
     */
    public function addPendingValidation(
        PendingValidationStock $pendingValidationStock
    )
    {
        $this->pendingValidations[] = $pendingValidationStock;
    }

    /**
     * @param InStockProduct $inStockProduct
     */
    public function addInStockProduct(InStockProduct $inStockProduct)
    {
        $this->inStockProducts[] = $inStockProduct;
    }

    /**
     * @param UserInWarehouse $userInWarehouse
     */
    public function addUserInWareHouse(UserInWarehouse $userInWarehouse)
    {
        $this->userInWarehouses[] = $userInWarehouse;
    }

    /**
     * @param PendingValidationStock $pendingValidationStock
     */
    public function  removePendingValidation(
        PendingValidationStock $pendingValidationStock
    )
    {
        $this->pendingValidations->removeElement($pendingValidationStock);
    }

    /**
     * @param InStockProduct $inStockProduct
     */
    public function removeInStockProduct(InStockProduct $inStockProduct)
    {
        $this->inStockProducts->removeElement($inStockProduct);
    }

    /**
     * @param UserInWarehouse $userInWarehouse
     */
    public function removeUserInWarehouse(UserInWarehouse $userInWarehouse)
    {
        $this->userInWarehouses->removeElement($userInWarehouse);
    }


    public function getPendingValidations()
    {
        return $this->pendingValidations;
    }


    public function getInStockProducts()
    {
        return $this->inStockProducts;
    }


    public function getUserInWarehouses()
    {
        return $this->userInWarehouses;
    }

}
