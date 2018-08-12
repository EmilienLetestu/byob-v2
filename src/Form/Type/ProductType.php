<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 21:15
 */

namespace App\Form\Type;

use App\DTO\ProductDTO;
use App\Entity\RefDetail;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('family', EntityType::class,[
                'class'        => RefDetail::class,
                'query_builder'=> function(EntityRepository $repository){
                    return $repository->createQueryBuilder('refD')
                        ->where('refD.constantKey = :family')
                        ->setParameter('family', 'family')
                     ;
                },
                'choice_label' => 'name'
            ])
            ->add('category', EntityType::class,[
                'class'        => RefDetail::class,
                'query_builder'=> function(EntityRepository $repository){
                    return $repository->createQueryBuilder('refD')
                        ->where('refD.constantKey = :category')
                        ->setParameter('category', 'category')
                    ;
                },
                'choice_label' => 'name'
            ])
            ->add('type', EntityType::class,[
                'class'        => RefDetail::class,
                'query_builder'=> function(EntityRepository $repository){
                    return $repository->createQueryBuilder('refD')
                        ->where('refD.constantKey = :type')
                        ->setParameter('type', 'type')
                    ;
                },
                'choice_label' => 'name'
            ])
            ->add('make', EntityType::class,[
                'class'        => RefDetail::class,
                'query_builder'=> function(EntityRepository $repository){
                    return $repository->createQueryBuilder('refD')
                        ->where('refD.constantKey = :make')
                        ->setParameter('make', 'make')
                    ;
                },
                'choice_label' => 'name'
            ])
            ->add('designation', EntityType::class,[
                'class'        => RefDetail::class,
                'query_builder'=> function(EntityRepository $repository){
                    return $repository->createQueryBuilder('refD')
                        ->where('refD.constantKey = :designation')
                        ->setParameter('designation', 'designation')
                    ;
                },
                'choice_label' => 'name'
            ])
            ->add('model', TextType::class,[
                'label' => 'Model'
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductDTO::class,
            'validation_groups' => 'product',
            'empty_data'        => function(FormInterface $form){
                return new ProductDTO(
                    $form->get('model')->getData(),
                    $form->get('family')->getData(),
                    $form->get('category')->getData(),
                    $form->get('type')->getData(),
                    $form->get('make')->getData(),
                    $form->get('designation')->getData()
                );
            }
        ]);
    }
}
