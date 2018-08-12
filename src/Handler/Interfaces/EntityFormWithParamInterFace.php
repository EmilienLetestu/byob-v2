<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 12/08/2018
 * Time: 11:24
 */

namespace App\Handler\Interfaces;


use Symfony\Component\Form\FormInterface;

/**
 * Interface EntityFormWithParamInterFace
 * @package App\Handler\Interfaces
 */
Interface EntityFormWithParamInterFace
{
    /**
     * @param FormInterface $form
     * @param string $routeParam
     * @return bool
     */
    public function handle(FormInterface $form, string $routeParam): bool;
}