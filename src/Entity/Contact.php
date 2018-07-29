<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 27/07/2018
 * Time: 14:19
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * where will be stored addresses, phone numbers....
 * Class Contact
 * @package App\Entity
 */
class Contact
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $type;

    /**
     * @var
     */
    private $data;

    /**
     * @var null
     */
    private $comment = null;

    /**
     * @var
     */
    private $person;

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @param string $data
     */
    public function setData(string $data): void
    {
        $this->data  = $data;
    }

    /**
     * @param null|string $comment
     */
    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @param Person $person
     */
    public function setPerson(Person $person): void
    {
        $this->person = $person;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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

    /**
     * @return Person
     */
    public function getPerson(): Person
    {
        return $this->person;
    }



}