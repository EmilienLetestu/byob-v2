<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 27/07/2018
 * Time: 13:54
 */

namespace App\Entity;

/**
 * keep records of all stock entrance validation requests
 * Class StockValidation
 * @package App\Entity
 */
class StockValidation
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $processedOn;

    /**
     * @var
     */
    private $pendingValidation;

    /**
     * @var
     */
    private $processedBy;


    /**
     * @param null|string $format
     */
    public function setProcessedOn(?string $format): void
    {
        $this->processedOn = new \DateTime(date($format));
    }

    /**
     * @param PendingValidationStock $pendingValidation
     */
    public function setPendingValidation(PendingValidationStock $pendingValidation): void
    {
        $this->pendingValidation = $pendingValidation;
    }

    /**
     * @param User|null $user
     */
    public function setProcessedBy(?User $user): void
    {
        $this->processedBy = $user;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTime|null
     */
    public function getProcessedOn():? \DateTime
    {
        return $this->processedOn;
    }

    /**
     * @return PendingValidationStock
     */
    public function getPendingValidation(): PendingValidationStock
    {
        return $this->pendingValidation;
    }

    /**
     * @return User|null
     */
    public function getProcessedBy():? User
    {
        return $this->processedBy;
    }

}
