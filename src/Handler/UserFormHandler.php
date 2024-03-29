<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 09:00
 */

namespace App\Handler;


use App\Entity\User;
use App\Entity\UserInWarehouse;
use App\Handler\Interfaces\FormHandlerInterface;
use App\Helper\IdentifierHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

class UserFormHandler implements FormHandlerInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * @var IdentifierHelper
     */
    private $helper;

    /**
     * UserFormHandler constructor.
     * @param EntityManagerInterface $doctrine
     * @param IdentifierHelper $helper
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        IdentifierHelper            $helper
    )
    {
        $this->user             = new User();
        $this->doctrine         = $doctrine;
        $this->helper           = $helper;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid())
        {
            $this->user->setName($form->get('name')->getData());
            $this->user->setSurname($form->get('surname')->getData());
            $this->user->setEmail($form->get('email')->getData());
            $this->user->setRole($form->get('role')->getData());

            $this->user->setAddedOn('Y-m-d');
            $this->user->setPassword(
                $this->helper->generateTempPassword(8)
            );
            $this->user->setToken(
                $this->helper->generateToken(20)
            );


            $this->doctrine->persist($this->user);

            $warehouses = $form->get('warehouses')->getData();

            foreach ($warehouses as $warehouse)
            {
                $userInWareHouse = new UserInWarehouse();
                $userInWareHouse->setAddedOn('Y-m-d');
                $userInWareHouse->setWarehouse($warehouse);
                $userInWareHouse->setUser($this->user);

                $this->doctrine->persist($userInWareHouse);
            }

            $this->doctrine->flush();

            return true;
        }

        return false;
    }


}