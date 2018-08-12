<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 12/08/2018
 * Time: 20:12
 */

namespace App\Form\Type;


use App\DTO\ContactDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class,[
                'choices' => [
                    'tél fixe'  => 'phone',
                    'portable'  => 'mobile',
                    'tel perso' => 'personal phone',
                    'email'     => 'email'
                ],
                'attr' => ['class' => 'browser-default']
            ])
            ->add('data', TextType::class,[
                'label' => 'données de contact'
            ])
            ->add('comment', TextType::class,[
                'label'   => 'commnetaire',
                'required' => false
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults([
           'data_class'        => ContactDTO::class,
           'validation_groups' => 'contact',
           'empty_data'        => function(FormInterface $form){
                return new ContactDTO(
                    $form->get('type')->getData(),
                    $form->get('data')->getData(),
                    $form->get('comment')->getData()
                );
           }
       ]);
    }
}