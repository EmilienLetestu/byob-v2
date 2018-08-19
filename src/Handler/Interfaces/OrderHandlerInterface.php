<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 19/08/2018
 * Time: 10:00
 */

namespace App\Handler\Interfaces;


use App\Entity\Orders;
use Symfony\Component\Form\FormInterface;

interface OrderHandlerInterface
{
    /**
     * @param FormInterface $form
     * @param Orders $order
     * @return bool
     */
    public function handle(FormInterface $form, Orders $order): bool;
}