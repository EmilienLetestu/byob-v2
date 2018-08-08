<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 10:39
 */

namespace App\Form\Type;



use App\DTO\InOrderProductDTO;
use App\Entity\InStockProduct;


use Doctrine\ORM\EntityRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InOrderProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', EntityType::class,[
                'class'         => InStockProduct::class,
                'query_builder' => function(EntityRepository $repository){
                    return $repository->createQueryBuilder('inStock')
                        ->distinct('product')
                    ;
                },
                'choice_label'  => 'product.model'
            ])
            ->add('quantity', IntegerType::class,[
                'label' => 'Quantité'
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'        => InOrderProductDTO::class,
            'validation_groups' => 'inOrder',
            'empty_data'        => function(FormInterface $form){
                return new InOrderProductDTO(
                    $form->get('product')->getData()->getProduct(),
                    $form->get('quantity')->getData()
                );
            }
        ]);
    }
}