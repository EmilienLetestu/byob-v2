<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 26/07/2018
 * Time: 17:51
 */

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

use Doctrine\ORM\Mapping as ORM;

class User implements UserInterface
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
    private $surname;

    /**
     * @var
     */
    private $email;

    /**
     * @var
     */
    private $password;

    /**
     * @var
     */
    private $role;

    /**
     * @var
     */
    private $addedOn;

    /**
     * @var bool
     */
    private $activated   = false;

    /**
     * @var null
     */
    private $activatedOn = null;

    /**
     * @var
     */
    private $token;

    /**
     * @var
     */
    private $person;

    /**
     * @var ArrayCollection
     */
    private $userInWarehouses;

    /**
     * @var ArrayCollection
     */
    private $orders;

    /**
     * @var ArrayCollection
     */
    private $pendingValidations;

    /**
     * @var ArrayCollection
     */
    private $stockValidations;

    /**
     * @var ArrayCollection
     */
    private $products;

    /**
     * @var ArrayCollection
     */
    private $refDetails;

    /**
     * @var ArrayCollection
     */
    private $refMasters;



    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @param string $format
     */
    public function setAddedOn(string $format): void
    {
        $this->addedOn = new \DateTime(date($format));
    }

    /**
     * @param bool $activated
     */
    public function setActivated(bool $activated): void
    {
        $this->activated = $activated;
    }

    /**
     * @param \DateTime|null $activatedOn
     */
    public function setActivatedOn(?\DateTime $activatedOn): void
    {
        $this->activatedOn = $activatedOn;
    }

    /**
     * @param null|string $token
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    /**
     * @param Person $person
     */
    public function setPerson(Person $person)
    {
        $this->person = $person;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getName():? string
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getSurname():? string
    {
        return $this->surname;
    }

    /**
     * @return null|string
     */
    public function getEmail():? string
    {
        return $this->email;
    }

    /**
     * @return null|string
     */
    public function getPassword():? string
    {
        return $this->password;
    }

    /**
     * @return null|string
     */
    public function getRole():? string
    {
        return $this->role;
    }

    /**
     * @return \DateTime|null
     */
    public function getAddedOn():? \DateTime
    {
        return $this->addedOn;
    }

    /**
     * @return bool|null
     */
    public function getActivated():? bool
    {
        return $this->activated;
    }

    /**
     * @return \DateTime|null
     */
    public function getActivatedOn():? \DateTime
    {
        return $this->activatedOn;
    }

    /**
     * @return null|string
     */
    public function getToken():? string
    {
        return $this->token;
    }

    /**
     * @return Person
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /*---------------------- UserInterface requested methods ------------------*/

    /**
     * @return null|string
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return [
            'ROLE_'.$this->getRole()
        ];
    }

    /**
     * @return null|string
     */
    public function getUsername()
    {
       return $this->getEmail();
    }

    public function eraseCredentials()
    {

    }

    /**
     * @return string
     */
    public function serialize() :string
    {
        return serialize([
            $this->id,
            $this->email
        ]);
    }

    /**
     * @param $serialized
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }

    /*----------------------- Array Collections -----------------------*/

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->orders             = new ArrayCollection();
        $this->pendingValidations = new ArrayCollection();
        $this->stockValidations   = new ArrayCollection();
        $this->products           = new ArrayCollection();
        $this->refDetails         = new ArrayCollection();
        $this->refMasters         = new ArrayCollection();
        $this->userInWarehouses   = new ArrayCollection();

    }

    /**
     * @param Orders $order
     */
    public function addInOrderProduct(Orders $order)
    {
        $this->orders[] = $order;
    }

    /**
     * @param PendingValidationStock $pendingValidation
     */
    public function addPendingValidation(
        PendingValidationStock $pendingValidation
    ){
        $this->pendingValidations[] = $pendingValidation;
    }

    /**
     * @param StockValidation $stockValidation
     */
    public function addStockValidation(StockValidation $stockValidation)
    {
        $this->stockValidations[] = $stockValidation;
    }

    /**
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    /**
     * @param RefDetail $refDetail
     */
    public function addRefDetail(RefDetail $refDetail)
    {
        $this->refDetails[] = $refDetail;
    }

    /**
     * @param RefMaster $refMaster
     */
    public function addRefMaster(RefMaster $refMaster)
    {
        $this->refMasters[] = $refMaster;
    }

    /**
     * @param UserInWarehouse $userInWarehouse
     */
    public function addUserInWarehouse(UserInWarehouse $userInWarehouse)
    {
        $this->userInWarehouses[] = $userInWarehouse;
    }

    /**
     * @param Orders $order
     */
    public function removeOrder(Orders $order)
    {
        $this->orders->removeElement($order);
    }

    /**
     * @param PendingValidationStock $pendingValidation
     */
    public function removePendingValidation(
        PendingValidationStock $pendingValidation
    )
    {
        $this->pendingValidations->removeElement($pendingValidation);
    }

    /**
     * @param StockValidation $stockValidation
     */
    public function removeStockValidation(StockValidation $stockValidation)
    {
        $this->stockValidations->removeElement($stockValidation);
    }

    /**
     * @param Product $product
     */
    public function removeProduct(Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * @param RefDetail $refDetail
     */
    public function removeRefDetail(RefDetail $refDetail)
    {
        $this->refDetails->removeElement($refDetail);
    }

    /**
     * @param RefMaster $refMaster
     */
    public function removeRefMaster(RefMaster $refMaster)
    {
        $this->refMasters->removeElement($refMaster);
    }

    /**
     * @param UserInWarehouse $userInWarehouse
     */
    public function removeUserInWarehouse(UserInWarehouse $userInWarehouse)
    {
        $this->userInWarehouses->removeElement($userInWarehouse);
    }


    public function getOrders()
    {
        return $this->orders;
    }


    public function getPendingValidations()
    {
        return $this->pendingValidations;
    }


    public function getStockValidations()
    {
        return $this->stockValidations;
    }


    public function getProducts()
    {
        return $this->products;
    }


    public function getRefDetails()
    {
        return $this->refDetails;
    }


    public function getRefMasters()
    {
        return $this->refMasters;
    }

    public function getUserInWarehouses()
    {
        return $this->userInWarehouses;
    }


}
