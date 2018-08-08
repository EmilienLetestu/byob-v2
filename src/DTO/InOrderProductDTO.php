<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 12:25
 */

namespace App\DTO;

use App\Entity\Product;

class InOrderProductDTO
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
     * InOrderProductDTO constructor.
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