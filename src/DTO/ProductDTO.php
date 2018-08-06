<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 21:51
 */

namespace App\DTO;


use App\Entity\Category;
use App\Entity\Designation;
use App\Entity\Family;
use App\Entity\Make;
use App\Entity\RefDetail;
use App\Entity\Type;

class ProductDTO
{
    /**
     * @var string
     */
    public $model;

    /**
     * @var RefDetail
     */
    public $family;

    /**
     * @var RefDetail
     */
    public $category;

    /**
     * @var RefDetail
     */
    public $type;

    /**
     * @var RefDetail
     */
    public $make;

    /**
     * @var RefDetail
     */
    public $designation;

    /**
     * ProductDTO constructor.
     * @param string $model
     * @param RefDetail $family
     * @param RefDetail $category
     * @param RefDetail $type
     * @param RefDetail $make
     * @param RefDetail $designation
     */
    public function __construct(
        string    $model,
        RefDetail $family,
        RefDetail $category,
        RefDetail $type,
        RefDetail $make,
        RefDetail $designation
    )
    {
        $this->model       = $model;
        $this->family      = $family;
        $this->category    = $category;
        $this->type        = $type;
        $this->make        = $make;
        $this->designation = $designation;
    }
}
