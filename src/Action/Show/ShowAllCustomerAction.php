<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 07/08/2018
 * Time: 21:17
 */

namespace App\Action\Show;

use App\Entity\Customer;
use App\Responder\Show\ShowAllCustomerResponder;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class ShowAllCustomerAction
 * @package App\Action
 */
class ShowAllCustomerAction
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * @var TokenStorageInterface
     */
    private $token;


    /**
     * ShowAllCustomerAction constructor.
     * @param EntityManagerInterface $doctrine
     * @param TokenStorageInterface $token
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        TokenStorageInterface  $token
    )
    {
        $this->doctrine = $doctrine;
        $this->token    = $token;
    }

    /**
     * @Route("/client", name="customerList")
     *
     * @param ShowAllCustomerResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(ShowAllCustomerResponder $responder): Response
    {
        $repo = $this->doctrine
            ->getRepository(Customer::class)
        ;

        $user = $this->token->getToken()->getUser();

       return
           $responder(
               $user->getRole() === 'ADMIN' ?
                   $repo->findAllCustomer() :
                   $repo->findUserCustomer($user->getId())
           )
       ;
    }
}
