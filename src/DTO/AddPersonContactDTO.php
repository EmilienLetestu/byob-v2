<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 12/08/2018
 * Time: 21:35
 */

namespace App\DTO;


class AddPersonContactDTO
{
    /**
     * @var string
     */
    public $fullname;

    /**
     * @var string
     */
    public $job;

    /**
     * @var array
     */
    public $contacts;

    /**
     * AddPersonContactDTO constructor.
     * @param string $fullname
     * @param string $job
     * @param array $contacts
     */
    public function __construct(
        string $fullname,
        string $job,
        array $contacts
    )
    {
        $this->fullname = $fullname;
        $this->job      = $job;
        $this->contacts = $contacts;
    }
}