<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 27/07/2018
 * Time: 13:48
 */

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;

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
    /***
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $family;

    /**
     * @var
     */
    private $type;

    /**
     * @var
     */
    private $category;

    /**
     * @var
     */
    private $make;

    /**
     * @var
     */
    private $model;

    /**
     * @var
     */
    private $designation;

    /**
     * @var
     */
    private $reference;

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
    private $pendingValidations;

    /**
     * @var
     */
    private $inStockProduct;

    /**
     * @var
     */
    private $inOrderProducts;


    /**
     * @param string $family
     */
    public function setFamily(string $family): void
    {
        $this->family = $family;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type  = $type;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * @param string $make
     */
    public function setMake(string $make): void
    {
        $this->make = $make;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    /**
     * @param string $designation
     */
    public function setDesignation(string $designation): void
    {
        $this->designation = $designation;
    }

    /**
     * @param string $reference
     */
    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * @param string $format
     */
    public function setReferencedOn(string $format): void
    {
        $this->referencedOn = new \DateTime($format);
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
     * @param InStockProduct $inStockProduct
     */
    public function setInStockProduct(InStockProduct $inStockProduct): void
    {
        $this->inStockProduct = $inStockProduct;
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
    public function getFamily(): string
    {
        return $this->family;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getMake(): string
    {
        return $this->make;
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
    public function getDesignation(): string
    {
        return $this->designation;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
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
     * @return mixed
     */
    public function getInStockProduct(): InStockProduct
    {
        return $this->inStockProduct;
    }

    /*----------------------- Array Collections -----------------------*/

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->inOrderProducts    = new ArrayCollection();
        $this->pendingValidations = new ArrayCollection();
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

    /**
     * @return ArrayCollection
     */
    public function getInOrderProducts(): ArrayCollection
    {
        return $this->inOrderProducts;
    }


    /**
     * @return ArrayCollection
     */
    public function getPendingValidations(): ArrayCollection
    {
        return $this->pendingValidations;
    }

}
