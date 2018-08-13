<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 12/08/2018
 * Time: 16:06
 */

namespace App\Handler;


use App\Entity\Contact;
use App\Entity\Customer;
use App\Entity\Person;
use App\Handler\Interfaces\EntityFormHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CreateCustomerHandler implements EntityFormHandlerInterface
{
    /**
     * @var
     */
    private $doctrine;

    /**
     * @var
     */
    private $tokenStorage;

    /**
     * @var
     */
    private $customer;

    /**
     * @var
     */
    private $person;


    /**
     * CreateCustomerHandler constructor.
     * @param EntityManagerInterface $doctrine
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        TokenStorageInterface  $tokenStorage
    )
    {
        $this->doctrine     = $doctrine;
        $this->tokenStorage = $tokenStorage;
        $this->customer     = new Customer();
        $this->person       = new Person();
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
       if($form->isSubmitted() && $form->isValid())
       {
           $this->customer->setCompany($form->get('company')->getData());
           $this->customer->setAddedBy(
               $this->tokenStorage->getToken()->getUser()
           );
           $this->customer->setAddress($form->get('address')->getData());
           $this->customer->setAddedOn('Y-m-d');

           $this->doctrine->persist($this->customer);

           $this->person->setCustomer($this->customer);
           $this->person->setFullName($form->get('fullname')->getData());
           $this->person->setJob($form->get('job')->getData());

           $this->doctrine->persist($this->person);

           $contact = new Contact();

           $contact->setType('email');
           $contact->setData($form->get('email')->getData());
           $contact->setPerson($this->person);

           $this->doctrine->persist($contact);

           if($form->get('mobile')->getData() !== null)
           {
               $mobile = new Contact();
               $mobile->setType('mobile');
               $mobile->setData($form->get('mobile')->getData());
               $mobile->setPerson($this->person);

               $this->doctrine->persist($mobile);
           }

           if($form->get('phone')->getData() !== null)
           {
               $phone = new Contact();
               $phone->setType('phone');
               $phone->setData($form->get('phone')->getData());
               $phone->setPerson($this->person);

               $this->doctrine->persist($phone);
           }

           $this->doctrine->flush();

          return true;
       }

       return false;
    }
}