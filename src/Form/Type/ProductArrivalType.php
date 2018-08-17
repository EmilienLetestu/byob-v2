<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 11:35
 */

namespace App\Form\Type;

use App\DTO\PendingValidationStockDTO;

use App\Entity\User;

use App\Entity\UserInWarehouse;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class PendingValidationType
 * @package App\Form\Type
 */
class ProductArrivalType extends AbstractType
{
    /**
     * @var TokenStorageInterface
     */
    private $token;

    /**
     * ProductArrivalType constructor.
     * @param TokenStorageInterface $token
     */
    public function __construct(TokenStorageInterface $token)
    {
        $this->token = $token;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', IntegerType::class,[
                'label' => 'Quantité livré'
            ])
            ->add('warehouse', EntityType::class,[
                'class'        => UserInWarehouse::class,
                'query_builder' => function(EntityRepository $repository){
                    return $repository->createQueryBuilder('inU')
                        ->where('inU.user = :userId')
                        ->setParameter('userId',
                            $this->token->getToken()->getUser()->getId()
                        )
                    ;
                },
                'choice_label' => 'warehouse.name'
            ])
        ;
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
                    $form->get('quantity')->getData(),
                    $form->get('warehouse')->getData()->getWarehouse()
                );
           },
           'route' => 'productArrival'
       ]);
    }
}