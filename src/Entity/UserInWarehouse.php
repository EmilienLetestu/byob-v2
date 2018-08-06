<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 06/08/2018
 * Time: 12:18
 */

namespace App\Entity;


use Symfony\Component\Validator\Constraints\Date;

class UserInWarehouse
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $addedOn;

    /**
     * @var
     */
    private $user;

    /**
     * @var
     */
    private $warehouse;


    /**
     * @param string $format
     */
    public function setAddedOn(string $format): void
    {
        $this->addedOn = new \DateTime(date($format));
    }


    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
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
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Warehouse
     */
    public function getWarehouse(): Warehouse
    {
        return $this->warehouse;
    }

    /**
     * @return \DateTime
     */
    public function getAddedOn(): \DateTime
    {
        return $this->addedOn;
    }
}
