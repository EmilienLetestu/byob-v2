<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 16:16
 */

namespace App\Handler;


use App\Entity\Warehouse;
use App\Handler\Interfaces\FormHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

class WareHouseFormHandler implements FormHandlerInterface
{
    /**
     * @var Warehouse
     */
    private $warehouse;

    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    public function __construct(
        EntityManagerInterface $doctrine
    )
    {
        $this->warehouse = new Warehouse();
        $this->doctrine  = $doctrine;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->warehouse->setName(
                $form->get('name')->getData())
            ;

            $this->warehouse->setAddress(
                $form->get('address')->getData()
            );

            $this->doctrine->persist($this->warehouse);
            $this->doctrine->flush();

            return true;
        }

        return false;
    }
}