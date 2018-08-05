<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 05/08/2018
 * Time: 20:53
 */

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class RefMaster
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
     * @var
     */
    private $refDetails;

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

    /*----------------------- Array Collections -----------------------*/

    /**
     * Product constructor.
     */
    public function __construct()
    {
       $this->refDetails = new ArrayCollection();
    }

    /**
     * @param RefDetail $refDetail
     */
    public function addRefDetail(RefDetail $refDetail): void
    {
        $this->refDetails[] = $refDetail;
    }

    /**
     * @param RefDetail $refDetail
     */
    public function removeRefDetail(RefDetail $refDetail): void
    {
        $this->refDetails->removeElement($refDetail);
    }


    public function getRefDetails()
    {
        return $this->refDetails;
    }

}