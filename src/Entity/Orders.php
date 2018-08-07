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

class Orders
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $reference;

    /**
     * @var
     */
    private $orderedOn;

    /**
     * @var
     */
    private $deliveredOn;

    /**
     * @var
     */
    private $payedOn;

    /**
     * @var
     */
    private $status;

    /**
     * @var
     */
    private $orderedBy;

    /**
     * @var
     */
    private $customer;

    /**
     * @var
     */
    private $inOrderProducts;

    /**
     * @param string $prefix
     */
    public function setReference(string $prefix): void
    {
        $this->reference = uniqid($prefix);
    }

    /**
     * @param string $format
     */
    public function setOrderedOn(string $format): void
    {
        $this->orderedOn = new \DateTime(date($format));
    }

    /**
     * @param \DateTime|null $deliveredOn
     */
    public function setDeliveredOn(?\DateTime $deliveredOn): void
    {
        $this->deliveredOn = $deliveredOn;
    }

    /**
     * @param \DateTime|null $payedOn
     */
    public function setPayedOn(?\DateTime $payedOn): void
    {
        $this->payedOn = $payedOn;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @param User $user
     */
    public function setOrderedBy(User $user): void
    {
        $this->orderedBy = $user;
    }

    /**
     * @param Customer $customer
     */
    public function setOrderedFor(Customer $customer): void
    {
        $this->customer = $customer;
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
    public function getReference(): string
    {
        return $this->reference;
    }


    /**
     * @return \DateTime
     */
    public function getOrderedOn(): \DateTime
    {
        return $this->orderedOn;
    }

    /**
     * @return mixed
     */
    public function getDeliveredOn():? \DateTime
    {
        return $this->deliveredOn;
    }

    /**
     * @return mixed
     */
    public function getPayedOn():? \DateTime
    {
        return $this->payedOn;
    }

    /**
     * @return mixed
     */
    public function getOrderedBy(): User
    {
        return $this->orderedBy;
    }

    /**
     * @return mixed
     */
    public function getOrderedFor(): Customer
    {
        return $this->customer;
    }

    /**
     * @return mixed
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /*----------------------- Array Collections -----------------------*/

    /**
     * Order constructor.
     */
    public function __construct()
    {
        $this->inOrderProducts = new ArrayCollection();
    }

    /**
     * @param InOrderProduct $inOrderProduct
     */
    public function addInOrderProduct(InOrderProduct $inOrderProduct)
    {
        $this->inOrderProducts[] = $inOrderProduct;
    }

    /**
     * @param InOrderProduct $inOrderProduct
     */
    public function removeInOrderProduct(InOrderProduct $inOrderProduct)
    {
        $this->inOrderProducts->removeElement($inOrderProduct);
    }

    /**
     * @return ArrayCollection
     */
    public function getInOrderProducts(): ArrayCollection
    {
        return $this->inOrderProducts;
    }

}