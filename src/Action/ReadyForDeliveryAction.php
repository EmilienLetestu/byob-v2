<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 27/08/2018
 * Time: 12:21
 */

namespace App\Action;


use App\Entity\Orders;
use App\Responder\ReadyForDeliveryResponder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReadyForDeliveryAction
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * ReadyForDeliveryAction constructor.
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
     * @param ReadyForDeliveryResponder $responder
     * @return Response
     */
    public function __invoke(Request $request, ReadyForDeliveryResponder $responder): Response
    {
        $referer = explode('/',$request->headers->get('referer'));


        $order = $this->doctrine->getRepository(Orders::class)
            ->findOrderWithId($request->get('id'))
        ;


        if($referer[4] === 'reliquats')
        {
            //check for remainings back orders


        }

        if($referer[4] === 'commande')
        {
            $order->setStatus('en attente d\'enlèvement');

        }




        $this->doctrine->flush();

        return $responder();
    }
}