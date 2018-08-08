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

    /**
     * OrderDTO constructor.
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
}