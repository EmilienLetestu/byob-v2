<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 12/08/2018
 * Time: 21:47
 */

namespace App\Handler;


use App\Entity\Contact;
use App\Entity\Customer;
use App\Entity\Person;
use App\Handler\Interfaces\FormWithParamInterFace;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

class AddCustomerContactHandler implements FormWithParamInterFace
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * @var Person
     */
    private $person;



    /**
     * AddCustomerContactHandler constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->person   = new Person();
    }

    /**
     * @param FormInterface $form
     * @param string $routeParam
     * @return bool
     */
    public function handle(FormInterface $form, string $routeParam): bool
    {
        if($form->isSubmitted() && $form->isValid())
        {
            $this->person->setFullName($form->get('fullname')->getData());
            $this->person->setJob($form->get('job')->getData());
            $this->person->setCustomer(
                $this->doctrine->getRepository(Customer::class)
                ->findCustomerWithId($routeParam)
            );

            $this->doctrine->persist($this->person);

            foreach ($form->get('contacts') as $contactDto)
            {
                $contact = new Contact();

                $contact->setType($contactDto->get('type')->getData());
                $contact->setData($contactDto->get('data')->getData());
                $contact->setComment($contactDto->get('comment')->getData());
                $contact->setPerson($this->person);

                $this->doctrine->persist($contact);
            }

            $this->doctrine->flush();

            return true;
        }

        return false;
    }
}