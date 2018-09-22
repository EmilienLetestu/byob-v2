<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 19/08/2018
 * Time: 09:44
 */

namespace App\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class OrderStatusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('status', ChoiceType::class, [
               'choices' => [
                   'en attente de validation' => 'en attente de validation',
                   'payé et validé'           => 'payé et validé',
                   'en attente d\'enlèvement' => 'en attente d\'enlèvement',
                   'en cours de livraison'    => 'en cours de livraison',
                   'livré'                    => 'livré'

               ],
               'attr' => ['class' => 'browser-default']
           ])
       ;
    }
}