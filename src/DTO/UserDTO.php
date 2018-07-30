<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 23:25
 */

namespace App\DTO;


use App\Entity\Warehouse;

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
    public $password;

    /**
     * @var string
     */
    public $role;

    /**
     * @var Warehouse
     */
    public $warehouse;

    /**
     * UserDTO constructor.
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param string $password
     * @param string $role
     * @param Warehouse $warehouse
     */
    public function __construct(
        string $name,
        string $surname,
        string $email,
        string $password,
        string $role,
        Warehouse $warehouse

    )
    {
        $this->name      = $name;
        $this->surname   = $surname;
        $this->email     = $email;
        $this->password  = $password;
        $this->role      = $role;
        $this->warehouse = $warehouse;
    }
}