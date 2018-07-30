<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 13:38
 */

namespace App\DTO;

/**
 * Class WarehouseDTO
 * @package App\DTO
 */
class WarehouseDTO
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $address;

    /**
     * WarehouseDTO constructor.
     * @param string $name
     * @param string $address
     */
    public function __construct(
        string $name,
        string $address
    )
    {
        $this->name    = $name;
        $this->address = $address;
    }
}
