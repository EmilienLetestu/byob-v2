<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 12/08/2018
 * Time: 15:35
 */

namespace App\DTO;


class CreateCustomerDTO
{
    /**
     * @var string
     */
    public $company;

    /**
     * @var
     */
    public $address;

    /**
     * @var string
     */
    public $fullname;

    /**
     * @var string
     */
    public $job;

    /**
     * @var null|string
     */
    public $phone;

    /**
     * @var null|string
     */
    public $mobile;

    /**
     * @var string
     */
    public $email;

    /**
     * CreateCustomerDTO constructor.
     * @param string $company
     * @param string $address
     * @param string $fullname
     * @param string $job
     * @param null|string $phone
     * @param null|string $mobile
     * @param string $email
     */
    public function __construct(
        string  $company,
        string  $address,
        string  $fullname,
        string  $job,
        ?string $phone,
        ?string $mobile,
        string  $email
    )
    {
        $this->company  = $company;
        $this->address  = $address;
        $this->fullname = $fullname;
        $this->job      = $job;
        $this->phone    = $phone;
        $this->mobile   = $mobile;
        $this->email    = $email;
    }
}