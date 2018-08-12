<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 12/08/2018
 * Time: 21:31
 */

namespace App\DTO;


class ContactDTO
{
    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $data;

    /**
     * @var null|string
     */
    public $comment;

    /**
     * ContactDTO constructor.
     * @param string $type
     * @param string $data
     * @param null|string $comment
     */
    public function __construct(
        string  $type,
        string  $data,
        ?string $comment
    )
    {
        $this->type    = $type;
        $this->data    = $data;
        $this->comment = $comment;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @return null|string
     */
    public function getComment():? string
    {
        return $this->comment;
    }
}
