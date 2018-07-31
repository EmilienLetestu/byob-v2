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
use App\Entity\Type;

class ProductDTO
{
    /**
     * @var string
     */
    public $model;

    /**
     * @var Family
     */
    public $family;

    /**
     * @var Category
     */
    public $category;

    /**
     * @var Type
     */
    public $type;

    /**
     * @var Make
     */
    public $make;

    /**
     * @var Designation
     */
    public $designation;

    /**
     * ProductDTO constructor.
     * @param string $model
     * @param Family $family
     * @param Category $category
     * @param Type $type
     * @param Make $make
     * @param Designation $designation
     */
    public function __construct(
        string      $model,
        Family      $family,
        Category    $category,
        Type        $type,
        Make        $make,
        Designation $designation
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
