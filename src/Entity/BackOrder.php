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
    private $prepared;

    /**
     * @var
     */
    private $preparedOn;

    /**
     * @var
     */
    private $delivered;

    /**
     * @var
     */
    private $deliveredOn;

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
     * @param bool $prepared
     */
    public  function setPrepared(bool $prepared): void
    {
        $this->prepared = $prepared;
    }

    /**
     * @param null|string $format
     */
    public function setPreparedOn(?string $format): void
    {
        $this->preparedOn = new \DateTime(date($format));
    }

    /**
     * @param bool $delivered
     */
    public function setDelivered(bool $delivered): void
    {
        $this->delivered = $delivered;
    }

    /**
     * @param null|string $format
     */
    public function setDeliveredOn(?string $format): void
    {
        $this->deliveredOn = new \DateTime(date($format));
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
     * @return bool
     */
    public function getPrepared(): bool
    {
        return $this->prepared;
    }

    /**
     * @return \DateTime|null
     */
    public function getPreparedOn(): ?\DateTime
    {
        return $this->preparedOn;
    }

    /**
     * @return bool
     */
    public function getDelivered(): bool
    {
        return $this->delivered;
    }

    /**
     * @return \DateTime|null
     */
    public function getDeliveredOn(): ?\DateTime
    {
        return $this->deliveredOn;
    }


    /**
     * @return InOrderProduct
     */
    public function getInOrderProduct(): InOrderProduct
    {
        return $this->inOrderProduct;
    }
}