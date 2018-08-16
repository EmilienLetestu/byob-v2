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

class ShowAllOrderAction
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * ShowAllOrderAction constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }


    /**
     * @Route("/commande", name="orderList")
     * @Route("/gerer-les-commandes", name="orderManagement")
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

        return
            $responder(
               $request->attributes->get('_route') === 'commande' ?
                   $repo->findAllOrder() : $repo->findOrderForAccountant()
            )
        ;
    }
}