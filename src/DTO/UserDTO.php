<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 23:25
 */

namespace App\DTO;


use App\Entity\Warehouse;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class UserDTO
 * @package App\DTO
 */
class UserDTO
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $surname;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $role;

    /**
     * @var ArrayCollection
     */
    public $warehouses;

    /**
     * UserDTO constructor.
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param string $role
     * @param ArrayCollection $warehouses
     */
    public function __construct(
        string $name,
        string $surname,
        string $email,
        string $role,
        ArrayCollection $warehouses

    )
    {
        $this->name      = $name;
        $this->surname   = $surname;
        $this->email     = $email;
        $this->role      = $role;
        $this->warehouses = $warehouses;
    }
}