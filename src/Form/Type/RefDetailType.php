<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 12/08/2018
 * Time: 10:59
 */

namespace App\Form\Type;


use App\DTO\RefDetailDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefDetailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Nom'
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults([
           'data_class'        => RefDetailDTO::class,
           'validation_groups' => 'refDetail',
           'empty_data'        => function(FormInterface $form){
                return new RefDetailDTO(
                    $form->get('name')->getData()
                );
           }

       ]);
    }
}
