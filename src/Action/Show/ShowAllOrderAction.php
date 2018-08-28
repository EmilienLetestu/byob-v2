<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 22:03
 */

namespace App\Action\Show;


use App\Entity\InOrderProduct;
use App\Entity\Orders;
use App\Responder\Show\ShowAllOrderResponder;

use App\Services\OrderListForRole;
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

    private $orderListForRole;

    /**
     * ShowAllOrderAction constructor.
     * @param EntityManagerInterface $doctrine
     * @param TokenStorageInterface $token
     * @param OrderListForRole $orderListForRole
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        TokenStorageInterface  $token,
        OrderListForRole       $orderListForRole
    )
    {
        $this->doctrine         = $doctrine;
        $this->token            = $token;
        $this->orderListForRole = $orderListForRole;
    }


    /**
     * @Route("/commande", name="orderList")
     *
     * @param Request $request
     * @param ShowAllOrderResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, ShowAllOrderResponder $responder): Response
    {
        return
            $responder(
                $this->orderListForRole->getOrderListForRole(
                    $this->doctrine->getRepository(Orders::class),
                    $this->token->getToken()->getUser(),
                    $this->doctrine->getRepository(InOrderProduct::class)
                )
            )
        ;
    }
}