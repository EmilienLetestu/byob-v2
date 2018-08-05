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
     * @var
     */
    private $refDetails;


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
        $this->reference = $reference;
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
     * @return InStockProduct|null
     */
    public function getInStockProduct():? InStockProduct
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
        $this->refDetails         = new ArrayCollection();
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
     * @param RefDetail $refDetail
     */
    public function addRefDetail(RefDetail $refDetail): void
    {
        $this->refDetails[] = $refDetail;
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
     * @param RefDetail $refDetail
     */
    public function removeRefDetail(RefDetail $refDetail): void
    {
        $this->refDetails->removeElement($refDetail);
    }

    public function getInOrderProducts()
    {
        return $this->inOrderProducts;
    }


    public function getPendingValidations()
    {
        return $this->pendingValidations;
    }


    public function getRefDetails()
    {
        return $this->refDetails;
    }

}
