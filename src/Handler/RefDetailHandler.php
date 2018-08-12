<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 12/08/2018
 * Time: 11:27
 */

namespace App\Handler;


use App\Entity\RefDetail;
use App\Entity\RefMaster;
use App\Handler\Interfaces\EntityFormWithParamInterFace;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class RefDetailHandler implements EntityFormWithParamInterFace
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * @var
     */
    private $tokenStorage;

    /**
     * @var RefDetail
     */
    private $refDetail;


    /**
     * RefDetailHandler constructor.
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
        $this->refDetail    = new RefDetail();
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
           $refMaster = $this->doctrine
               ->getRepository(RefMaster::class)
               ->findRefWithName($routeParam)
           ;

           $this->refDetail->setName($form->get('name')->getData());
           $this->refDetail->setAddedOn('Y-m-d');
           $this->refDetail->setAddedBy(
               $this->tokenStorage->getToken()->getUser()
           );
           $this->refDetail->setConstantKey($routeParam);
           $this->refDetail->setRefMaster($refMaster);

           $this->doctrine->persist($this->refDetail);
           $this->doctrine->flush();

           return true;
       }

       return false;
    }
}