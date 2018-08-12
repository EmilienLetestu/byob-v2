<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 12/08/2018
 * Time: 20:09
 */

namespace App\Form\Type;


use App\DTO\AddPersonContactDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddPersonContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('fullname', TextType::class,[
               'label' => 'nom et prénom'
           ])
           ->add('job', ChoiceType::class,[
               'choices' => [
                   'directeur'         => 'directeur',
                   'gérant'            => 'gérant',
                   'responsable achat' => 'responsable achat'
               ]
           ])
           ->add('contacts', CollectionType::class,[
               'entry_type' => ContactType::class,
               'allow_add'    => true,
               'allow_delete' => true,
               'by_reference' => false,
               'mapped'       => false,
               'required'     => false,
               'prototype'    => true,
               'label'        => 'Informations de contact'
           ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'        => AddPersonContactDTO::class,
            'validation_groups' => 'addContact',
            'empty_data'        => function(FormInterface $form){
                return new AddPersonContactDTO(
                    $form->get('fullname')->getData(),
                    $form->get('job')->getData(),
                    $form->get('contacts')->getData()
                );
            }
        ]);
    }
}