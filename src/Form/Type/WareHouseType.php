<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 13:32
 */

namespace App\Form\Type;



use App\DTO\WarehouseDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WareHouseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'label' => 'Nom de l\'entrepôt'
            ])
            ->add('address', TextType::class,[
                'label' => 'Adresse de l\'entrpôt'
            ])
        ;
    }


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'        => WarehouseDTO::class,
            'validation_groups' => 'warehouse',
            'empty_data'        => function(FormInterface $form){
                return new WarehouseDTO(
                    $form->get('name')->getData(),
                    $form->get('address')->getData()
                );
            }
        ]);
    }
}