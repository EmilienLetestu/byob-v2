<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 17/08/2018
 * Time: 10:15
 */

namespace App\DTO;


use App\Entity\Product;

class ArrivalDTO
{
    /**
     * @var Product
     */
    public $product;

    /**
     * @var int
     */
    public $quantity;

    /**
     * ArrivalDTO constructor.
     * @param Product $product
     * @param int $quantity
     */
    public function __construct(
        Product $product,
        int     $quantity
    )
    {
        $this->product  = $product;
        $this->quantity = $quantity;
    }
}