<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 27/07/2018
 * Time: 13:56
 */

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * where will be stored personal information about a given user, client, provider....
 *
 * Class Person
 * @package App\Entity
 */
class Person
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $fullName;

    /**
     * @var
     */
    private $birthday;

    /**
     * @var
     */
    private $job;

    /**
     * @var
     */
    private $user;

    /**
     * @var ArrayCollection
     */
    private $contacts;

    /**
     * @var ArrayCollection
     */
    private $orders;

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @param \DateTime|null $birthday
     */
    public function setBirthday(?\DateTime $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @param null|string $job
     */
    public function setJob(?string $job): void
    {
        $this->job = $job;
    }

    /**
     * @param User|null $user
     */
    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        $this->id;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return \DateTime|null
     */
    public function getBirthday():? \DateTime
    {
        return $this->birthday;
    }

    /**
     * @return null|string
     */
    public function getJob():? string
    {
        return $this->job;
    }

    /**
     * @return User|null
     */
    public function getUser():? User
    {
        return $this->user;
    }

    /*----------------------- Array Collections -----------------------*/

    /**
     * Person constructor.
     */
    public function __construct()
    {
        $this->contacts = new ArrayCollection();
        $this->orders   = new ArrayCollection();
    }

    /**
     * @param Contact $contact
     */
    public function addContact(Contact $contact)
    {
        $this->contacts[] = $contact;
    }

    /**
     * @param Contact $contact
     */
    public function removeContact(Contact $contact)
    {
        $this->contacts->removeElement($contact);
    }

    /**
     * @return ArrayCollection
     */
    public function getContacts(): ArrayCollection
    {
        return $this->contacts;
    }

    /**
     * @param Orders $order
     */
    public function addOrder(Orders $order)
    {
        $this->orders[] = $order;
    }

    /**
     * @param Orders $order
     */
    public function removeOrder(Orders $order)
    {
        $this->orders->removeElement($order);
    }

    /**
     * @return ArrayCollection
     */
    public function getOrders(): ArrayCollection
    {
        return $this->orders;
    }




}