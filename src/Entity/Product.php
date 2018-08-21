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
 * where we will be able to store newly created product/reference
 * where all the referenced products are stored whether they are available for retail or not
 * each time a new product is created it will be added to the "InStockProduct" table with an "inStockProduct" level set to null
 *
 * Class Product
 * @package App\Entity
 */
class Product
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $model;

    /**
     * @var
     */
    private $reference;

    /**
     * @var
     */
    private $price;

    /**
     * @var
     */
    private $referencedOn;

    /**
     * @var null
     */
    private $lastModification = null;

    /**
     * @var
     */
    private $referencedBy;

    /**
     * @var
     */
    private $family;

    /**
     * @var
     */
    private $category;


    /**
     * @var
     */
    private $type;

    /**
     * @var
     */
    private $make;

    /**
     * @var
     */
    private $designation;

    /**
     * @var ArrayCollection
     */
    private $pendingValidations;

    /**
     * @var ArrayCollection
     */
    private $inStockProducts;

    /**
     * @var ArrayCollection
     */
    private $inOrderProducts;


    /**
     * @param string $model
     */
    public function setModel(string $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $reference
     */
    public function setReference(string $reference): void
    {
        $this->reference = uniqid($reference);
    }

    /**
     * @param float|null $price
     */
    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    /**
     * @param string $format
     */
    public function setReferencedOn(string $format): void
    {
        $this->referencedOn = new \DateTime(date($format));
    }

    /**
     * @param null|string $format
     */
    public function setLastModification(?string $format): void
    {
        $format !== null ?
            $this->lastModification = new \DateTime(date($format)) : null
        ;
    }

    /**
     * @param User $user
     */
    public function setReferencedBy(User $user): void
    {
        $this->referencedBy = $user;
    }

    /**
     * @param mixed $family
     */
    public function setFamily(RefDetail $family): void
    {
        $this->family = $family;
    }

    /**
     * @param mixed $category
     */
    public function setCategory(RefDetail $category): void
    {
        $this->category = $category;
    }

    /**
     * @param mixed $type
     */
    public function setType(RefDetail $type): void
    {
        $this->type = $type;
    }

    /**
     * @param mixed $make
     */
    public function setMake(RefDetail $make): void
    {
        $this->make = $make;
    }

    /**
     * @param mixed $designation
     */
    public function setDesignation(RefDetail $designation): void
    {
        $this->designation = $designation;
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
    public function getModel(): string
    {
        return $this->model;
    }


    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @return \DateTime
     */
    public function getReferencedOn(): \DateTime
    {
        return $this->referencedOn;
    }

    /**
     * @return \DateTime|null
     */
    public function getLastModification():? \DateTime
    {
        return $this->lastModification;
    }

    /**
     * @return User
     */
    public function getReferencedBy(): User
    {
        return $this->referencedBy;
    }

    /**
     * @return RefDetail
     */
    public function getFamily(): RefDetail
    {
        return $this->family;
    }

    /**
     * @return RefDetail
     */
    public function getType(): RefDetail
    {
        return $this->type;
    }

    /**
     * @return RefDetail
     */
    public function getCategory(): RefDetail
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getMake(): RefDetail
    {
        return $this->make;
    }

    /**
     * @return mixed
     */
    public function getDesignation(): RefDetail
    {
        return $this->designation;
    }


    /*----------------------- Array Collections -----------------------*/

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->inOrderProducts    = new ArrayCollection();
        $this->pendingValidations = new ArrayCollection();
        $this->inStockProducts    = new ArrayCollection();
    }

    /**
     * @param InOrderProduct $inOrderProduct
     */
    public function addInOrderProduct(InOrderProduct $inOrderProduct): void
    {
        $this->inOrderProducts[] = $inOrderProduct;
    }


    /**
     * @param PendingValidationStock $pendingValidationStock
     */
    public function addPendingValidation(
        PendingValidationStock $pendingValidationStock
    ): void
    {
        $this->pendingValidations[] = $pendingValidationStock;
    }


    /**
     * @param InStockProduct $inStockProduct
     */
    public function addInStockProduct(InStockProduct $inStockProduct): void
    {
        $this->inStockProducts[] = $inStockProduct;
    }

    /**
     * @param InOrderProduct $inOrderProduct
     */
    public function removeInOrderProduct(InOrderProduct $inOrderProduct): void
    {
        $this->inOrderProducts->removeElement($inOrderProduct);
    }

    /**
     * @param PendingValidationStock $pendingValidationStock
     */
    public function removePendingValidation(
        PendingValidationStock $pendingValidationStock
    ): void
    {
        $this->pendingValidations->removeElement($pendingValidationStock);
    }

    public function removeInStockProduct(InStockProduct $inStockProduct): void
    {
        $this->inStockProducts->removeElement($inStockProduct);
    }

    public function getInOrderProducts()
    {
        return $this->inOrderProducts;
    }


    public function getPendingValidations()
    {
        return $this->pendingValidations;
    }


    public function getInStockProducts()
    {
        return $this->inStockProducts;
    }

}
