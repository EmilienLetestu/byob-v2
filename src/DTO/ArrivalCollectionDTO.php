<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 17/08/2018
 * Time: 10:26
 */

namespace App\DTO;


use App\Entity\Warehouse;

class ArrivalCollectionDTO
{
    /**
     * @var Warehouse
     */
    public $warehouse;

    /**
     * @var array
     */
    public $arrivals;

    /**
     * ArrivalCollectionDTO constructor.
     * @param Warehouse $warehouse
     * @param array $arrivals
     */
    public function __construct(
        Warehouse $warehouse,
        array     $arrivals
    )
    {
        $this->warehouse = $warehouse;
        $this->arrivals  = $arrivals;
    }
}