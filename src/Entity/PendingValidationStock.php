<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 27/07/2018
 * Time: 13:53
 */

namespace App\Entity;


/**
 * where a product goes while it hasn't been validated yet
 * when the validation has been granted the quantity is added to the matching "InStockProduct" level
 *
 * Class PendingValidationStock
 *
 * @package App\Entity
 */
class PendingValidationStock
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
    private $processed = false;

    /**
     * @var
     */
    private $validated = null;

    /**
     * @var
     */
    private $askedOn;

    /**
     * @var
     */
    private $processedOn = null;

    /**
     * @var
     */
    private $product;

    /**
     * @var
     */
    private $askedBy;

    /**
     * @var
     */
    private $stockValidation;

    /**
     * @var
     */
    private $warehouse;


    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @param bool $processed
     */
    public function setProcessed(bool $processed): void
    {
        $this->processed = $processed;
    }


    /**
     * @param bool|null $validated
     */
    public function setValidated(?bool $validated): void
    {
        $this->validated = $validated;
    }

    /**
     * @param string $format
     */
    public function setAskedOn(string $format): void
    {
        $this->askedOn = new \DateTime(date($format));
    }

    /**
     * @param \DateTime|null $processedOn
     */
    public function setProcessedOn(?\DateTime $processedOn): void
    {
        $this->processed = $processedOn;
    }


    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @param User $user
     */
    public function setAskedBy(User $user): void
    {
        $this->askedBy = $user;
    }

    /**
     * @param StockValidation $stockValidation
     */
    public function setStockValidation(StockValidation $stockValidation): void
    {
        $this->stockValidation = $stockValidation;
    }

    /**
     * @param Warehouse $warehouse
     */
    public function setWarehouse(Warehouse $warehouse): void
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
     * @return bool|null
     */
    public function getValidated():? bool
    {
        return $this->validated;
    }

    /**
     * @return \DateTime
     */
    public function getAskedOn(): \DateTime
    {
        return $this->askedOn;
    }

    /**
     * @return bool|null
     */
    public function getProcessed():? bool
    {
        return $this->processed;
    }

    /**
     * @return bool|null
     */
    public function getProcessedOn():? bool
    {
        return $this->processedOn;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return User
     */
    public function getAskedBy(): User
    {
        return $this->askedBy;
    }

    /**
     * @return StockValidation
     */
    public function getStockValidation(): StockValidation
    {
        return $this->stockValidation;
    }

    /**
     * @return Warehouse
     */
    public function getWarehouse(): Warehouse
    {
        return $this->warehouse;
    }

}
