<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 07/08/2018
 * Time: 19:49
 */

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Customer
 * @package App\Entity
 */
class Customer
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $company;

    /**
     * @var
     */
    private $addedOn;

    /**
     * @var
     */
    private $lastModification = null;

    /**
     * @var
     */
    private $addedBy;

    /**
     * @var ArrayCollection
     */
    private $persons;

    /**
     * @var ArrayCollection
     */
    private $orders;


    /**
     * @param string $company
     */
    public function setCompany(string $company): void
    {
        $this->company = $company;
    }

    /**
     * @param string $format
     */
    public function setAddedOn(string $format)
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
    public function getCompany(): string
    {
        return $this->company;
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
        return $this->addedOn;
    }

    /**
     * @return User
     */
    public function getAddedBy(): User
    {
        return $this->addedBy;
    }

    /*----------------------- Array Collections -----------------------*/

    /**
     * Customer constructor.
     */
    public function __construct()
    {
        $this->persons = new ArrayCollection();
        $this->orders  = new ArrayCollection();
    }

    /**
     * @param Person $person
     */
    public function addPerson(Person $person): void
    {
        $this->persons[] = $person;
    }

    /**
     * @param Orders $order
     */
    public function addOrder(Orders $order): void
    {
        $this->orders[] = $order;
    }

    /**
     * @param Person $person
     */
    public function removePerson(Person $person): void
    {
        $this->persons->removeElement($person);
    }

    /**
     * @param Orders $order
     */
    public function removeOrder(Orders $order): void
    {
        $this->orders->removeElement($order);
    }

    public function getPersons()
    {
        return $this->persons;
    }

    public function getOrders()
    {
        return $this->orders;
    }
}
