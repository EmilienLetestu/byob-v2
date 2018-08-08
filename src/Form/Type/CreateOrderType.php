<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 11:07
 */

namespace App\Form\Type;


use App\DTO\OrderDTO;
use App\Entity\Customer;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateOrderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('customer',EntityType::class,[
               'class' => Customer::class,
               'choice_label' => 'company'
           ])
       ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'        => OrderDTO::class,
            'validation_groups' => 'order',
            'empty_data'        => function(FormInterface $form){
                return new OrderDTO(
                    $form->get('customer')->getData()
                );
            }
        ]);
    }
}