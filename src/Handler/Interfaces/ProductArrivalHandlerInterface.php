<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 13:23
 */

namespace App\Handler\Interfaces;


use App\Entity\Product;
use Symfony\Component\Form\FormInterface;

Interface ProductArrivalHandlerInterface
{
    /**
     * @param FormInterface $form
     * @param Product $product
     * @return bool
     */
    public function handle(FormInterface $form, Product $product): bool;
}