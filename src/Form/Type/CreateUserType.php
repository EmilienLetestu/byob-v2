<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 23:15
 */

namespace App\Form\Type;

use App\DTO\UserDTO;
use App\Entity\Warehouse;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AddUserType
 * @package App\Form\Type
 */
class CreateUserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Prénom'
            ])
            ->add('surname', TextType::class,[
                'label' => 'Nom'
            ])
            ->add('email', TextType::class,[
                'label' => 'E-mail'
            ])
            ->add('role', ChoiceType::class,[
                'choices'=> [
                    'Financier'              => 'ACCOUNTANT',
                    'Responsable appro'      => 'SUPPLY',
                    'Responsable logistique' => 'LOGISTIC',
                    'Commercial'             => 'SALESMAN',
                    'Magasinier'             => 'WAREHOUSEMAN',
                    'Livreur'                => 'DELIVERYMAN'
                ]
            ])
            ->add('warehouse',EntityType::class,[
                'class' => Warehouse::class,
                'choice_label' => 'name'
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'        => UserDTO::class,
            'validation_groups' => 'user',
            'empty_data'        => function(FormInterface $form){
                return new UserDTO(
                    $form->get('name')->getData(),
                    $form->get('surname')->getData(),
                    $form->get('email')->getData(),
                    $form->get('role')->getData(),
                    $form->get('warehouse')->getData()
                );
            }
        ]);
    }
}