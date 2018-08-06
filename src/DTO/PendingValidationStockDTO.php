<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 11:40
 */

namespace App\DTO;


use App\Entity\Warehouse;

class PendingValidationStockDTO
{
    /**
     * @var int
     */
    public $quantity;

    /**
     * @var
     */
    public $warehouse;

    /**
     * PendingValidationStockDTO constructor.
     * @param int $quantity
     * @param Warehouse $warehouse
     */
    public function __construct(
        int $quantity,
        Warehouse $warehouse
    )
    {
        $this->quantity  = $quantity;
        $this->warehouse = $warehouse;
    }

}