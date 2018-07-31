<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 16:30
 */

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;

/**
 * Where to set and store some products categories
 *
 * Class Category
 * @package App\Entity
 */
class Category
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
    private $addedOn;

    /**
     * @var null
     */
    private $lastModification = null;

    /**
     * @var
     */
    private $addedBy;

    /**
     * @var ArrayCollection
     */
    private $products;

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $format
     */
    public function setAddedOn(string $format): void
    {
        $this->addedOn = new \DateTime(date($format));
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
    public function setAddedBy(User $user): void
    {
        $this->addedBy = $user;
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
     * @return \DateTime
     */
    public function getAddedOn(): \DateTime
    {
        return $this->addedOn;
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
    public function getAddedBy(): User
    {
        return $this->addedBy;
    }

    /*----------------------------------------ArrayCollection------------------------------------------------*/


    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    /**
     * @param Product $product
     */
    public function removeProduct(Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * @return ArrayCollection
     */
    public function getProducts(): ArrayCollection
    {
        return $this->products;
    }

}