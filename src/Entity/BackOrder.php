<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 26/08/2018
 * Time: 16:02
 */

namespace App\Entity;


class BackOrder
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $since;

    /**
     * @var
     */
    private $regularize;

    /**
     * @var
     */
    private $regularizedOn;

    /**
     * @var
     */
    private $inOrderProduct;

    /**
     * @param string $format
     */
    public function setSince(string $format): void
    {
        $this->since = new \DateTime(date($format));
    }

    /**
     * @param bool $regularize
     */
    public function setRegularize(bool $regularize): void
    {
        $this->regularize = $regularize;
    }

    /**
     * @param null|string $format
     */
    public function setRegularizedOn(?string $format): void
    {
         $this->regularizedOn = new \DateTime(date($format));
    }

    /**
     * @param InOrderProduct $inOrder
     */
    public function setInOrderProduct(InOrderProduct $inOrder): void
    {
        $this->inOrderProduct = $inOrder;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getSince(): \DateTime
    {
        return $this->since;
    }

    /**
     * @return bool
     */
    public function getRegularize(): bool
    {
        return $this->regularize;
    }

    /**
     * @return \DateTime|null
     */
    public function getRegularizedOn(): ?\DateTime
    {
        return $this->regularizedOn;
    }


    /**
     * @return InOrderProduct
     */
    public function getInOrderProduct(): InOrderProduct
    {
        return $this->inOrderProduct;
    }
}