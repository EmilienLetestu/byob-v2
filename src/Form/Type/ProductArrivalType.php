<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 11:35
 */

namespace App\Form\Type;
use App\DTO\PendingValidationStockDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PendingValidationType
 * @package App\Form\Type
 */
class ProductArrivalType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', IntegerType::class,[
                'label' => 'Quantité livré'
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults([
           'data_class'        => PendingValidationStockDTO::class,
           'validation_groups' => 'arrival',
           'empty_data'        => function(FormInterface $form){
                return new PendingValidationStockDTO(
                    $form->get('quantity')->getData()
                );
           }
       ]);
    }
}