<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 27/07/2018
 * Time: 13:48
 */

namespace App\Entity;


class Order
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $reference;

    /**
     * @var
     */
    private $orderedOn;

    /**
     * @var
     */
    private $deliveredOn;

    /**
     * @var
     */
    private $payedOn;

    /**
     * @var
     */
    private $status;

}