<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 11:15
 */

namespace App\DTO;


use App\Entity\Customer;

class OrderDTO
{
    /**
     * @var Customer
     */
    public $customer;

    public $inOrderProducts;

    /**
     * OrderDTO constructor.
     * @param Customer $customer
     * @param array $inOrderProducts
     */
    public function __construct(
        Customer $customer,
        array    $inOrderProducts
    )
    {
        $this->customer        = $customer;
        $this->inOrderProducts = $inOrderProducts;
    }
}