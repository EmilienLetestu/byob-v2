<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 11:40
 */

namespace App\DTO;


class PendingValidationStockDTO
{
    /**
     * @var int
     */
    public $quantity;

    /**
     * PendingValidationStockDTO constructor.
     * @param int $quantity
     */
    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

}