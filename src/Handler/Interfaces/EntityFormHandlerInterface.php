<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 16:11
 */

namespace App\Handler\Interfaces;


use Symfony\Component\Form\FormInterface;

/**
 * Interface EntityFormHandlerInterface
 * @package App\Handler\Interfaces
 */
Interface EntityFormHandlerInterface
{
    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool;
}