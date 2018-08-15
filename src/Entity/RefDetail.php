<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 05/08/2018
 * Time: 20:54
 */

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class RefDetail
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
    private $constantKey;

    /**
     * @var
     */
    private $refMaster;

    /**
     * @var ArrayCollection
     */
    private $categories;

    /**
     * @var ArrayCollection
     */
    private $families;

    /**
     * @var ArrayCollection
     */
    private $types;

    /**
     * @var ArrayCollection
     */
    private $makes;

    /**
     * @var ArrayCollection
     */
    private $designations;

    
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
     * @param RefMaster $refMaster
     */
    public function setRefMaster(RefMaster $refMaster): void
    {
        $this->refMaster = $refMaster;
    }

    /**
     * @param string $constantKey
     */
    public function setConstantKey(string $constantKey): void
    {
        $this->constantKey = $constantKey;
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

    /**
     * @return RefMaster
     */
    public function getRefMaster(): RefMaster
    {
        return $this->refMaster;
    }

    /**
     * @return string
     */
    public function getConstantKey(): string
    {
        return $this->constantKey;
    }

    /*----------------------- Array Collections -----------------------*/

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->categories    = new ArrayCollection();
        $this->families      = new ArrayCollection();
        $this->types         = new ArrayCollection();
        $this->designations  = new ArrayCollection();
        $this->makes         = new ArrayCollection();
    }


}