<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 22:03
 */

namespace App\Action\Show;


use App\Entity\Orders;
use App\Responder\Show\ShowAllOrderResponder;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use SYmfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ShowAllOrderAction
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
     * ShowAllOrderAction constructor.
     * @param EntityManagerInterface $doctrine
     * @param TokenStorageInterface $token
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        TokenStorageInterface  $token
    )
    {
        $this->doctrine  = $doctrine;
        $this->token     = $token;
    }


    /**
     * @Route("/commande", name="orderList")
     *
     * @param ShowAllOrderResponder $responder
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, ShowAllOrderResponder $responder): Response
    {
        $repo = $this->doctrine
            ->getRepository(Orders::class)
        ;

        $user = $this->token->getToken()->getUser();

        return
            $responder(
                $user->getRole() === 'ADMIN' ? $repo->findAllOrder() :
                      (
                        $user->getRole() === 'ACCOUNTANT' ?
                        $repo->findOrderForAccountant() :
                            $repo->findAllOrderWithUser($user->getId())
                      )
            )
        ;
    }
}