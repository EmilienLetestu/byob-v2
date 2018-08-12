<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 12/08/2018
 * Time: 11:05
 */

namespace App\DTO;


/***
 * Class RefDetailDTO
 * @package App\DTO
 */
class RefDetailDTO
{
    /**
     * @var string
     */
    public $name;

    /**
     * RefDetailDTO constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}