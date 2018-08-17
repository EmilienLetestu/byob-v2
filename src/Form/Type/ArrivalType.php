<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 16/08/2018
 * Time: 21:57
 */

namespace App\Form\Type;


use App\DTO\ArrivalDTO;
use App\Entity\Product;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArrivalType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', EntityType::class,[
                'class'        => Product::class,
                'choice_label' => 'model',
                'attr'         => ['class' => 'browser-default']
            ])

            ->add('quantity', IntegerType::class,[
                'label' => 'Quantité livré'
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'        => ArrivalDTO::class,
            'validation_groups' => 'arrival',
            'empty_data'        => function(FormInterface $form){
                return new ArrivalDTO(
                    $form->get('product')->getData(),
                    $form->get('quantity')->getData()
                );
            }
        ]);
    }
}