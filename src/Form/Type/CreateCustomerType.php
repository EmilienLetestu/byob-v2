<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 12/08/2018
 * Time: 15:19
 */

namespace App\Form\Type;

use App\DTO\CreateCustomerDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateCustomerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('company', TextType::class,[
               'label' => 'Nom de la société'
           ])
           ->add('address', TextType::class,[
               'label' => 'Adresse'
           ])
           ->add('fullname', TextType::class,[
               'label' => 'nom et prénom (gérant, contact...)'
           ])
           ->add('job', ChoiceType::class,[
               'choices' => [
                   'directeur'         => 'directeur',
                   'gérant'            => 'gérant',
                   'responsable achat' => 'responsable achat'
               ]
           ])
           ->add('phone', TextType::class,[
               'label'    => 'téléphone fixe',
               'required' => false
           ])
           ->add('mobile', TextType::class,[
               'label'    => 'téléphone portable',
               'required' => false
           ])
           ->add('email', EmailType::class,[
               'label' => 'email'
           ])
       ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'        => CreateCustomerDTO::class,
            'validation_groups' => 'createCustomer',
            'empty_data'        => function(FormInterface $form){
                return new CreateCustomerDTO(
                    $form->get('company')->getData(),
                    $form->get('address')->getData(),
                    $form->get('fullname')->getData(),
                    $form->get('job')->getData(),
                    $form->get('phone')->getData(),
                    $form->get('mobile')->getData(),
                    $form->get('email')->getData()
                );
            }
        ]);
    }
}