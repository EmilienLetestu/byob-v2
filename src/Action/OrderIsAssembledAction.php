<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 27/08/2018
 * Time: 12:21
 */

namespace App\Action;


use App\Entity\Orders;
use App\Responder\OrderIsAssembledResponder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderIsAssembledAction
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * OrderIsAssembledAction constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @Route(
     *     "commande-assemblee/{id}",
     *     name="orderPrepared",
     *     requirements={"id" = "\d+"}
     * )
     *
     * @param Request $request
     * @param OrderIsAssembledResponder $responder
     * @return Response
     */
    public function __invoke(Request $request, OrderIsAssembledResponder $responder): Response
    {
        $order = $this->doctrine->getRepository(Orders::class)
            ->findOrderWithId($request->get('id'))
        ;

        $order->setStatus('commande assemblé');

        $this->doctrine->flush();

        return $responder();
    }
}