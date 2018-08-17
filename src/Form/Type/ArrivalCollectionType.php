<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 17/08/2018
 * Time: 10:06
 */

namespace App\Form\Type;


use App\DTO\ArrivalCollectionDTO;
use App\Entity\UserInWarehouse;

use Doctrine\ORM\EntityRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ArrivalCollectionType extends AbstractType
{
    /**
     * @var TokenStorageInterface
     */
    private $token;

    /**
     * ArrivalCollectionType constructor.
     * @param TokenStorageInterface $token
     */
    public function __construct(TokenStorageInterface $token)
    {
        $this->token = $token;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder

           ->add('warehouse', EntityType::class,[
               'class'         => UserInWarehouse::class,
               'query_builder' => function(EntityRepository $repository){
                   return $repository->createQueryBuilder('inU')
                       ->where('inU.user = :userId')
                       ->setParameter('userId',
                           $this->token->getToken()->getUser()->getId()
                       )
                   ;
               },
               'choice_label' => 'warehouse.name'
           ])

           ->add('arrivals', CollectionType::class,[
               'entry_type' => ArrivalType::class,
               'allow_add'    => true,
               'allow_delete' => true,
               'by_reference' => false,
               'mapped'       => false,
               'required'     => true,
               'prototype'    => true,
               'label'        => ' '
           ])
       ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArrivalCollectionDTO::class,
            'empty_data' => function(FormInterface $form){
                return new ArrivalCollectionDTO(
                    $form->get('warehouse')->getData()->getWarehouse(),
                    $form->get('arrivals')->getData()
                );
            }
        ]);
    }
}
