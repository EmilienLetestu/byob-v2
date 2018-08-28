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
use App\Services\PrepareForDelivery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReadyForDeliveryAction
{
    /**
     * @var PrepareForDelivery
     */
    private $prepareForDelivery;

    /**
     * ReadyForDeliveryAction constructor.
     * @param PrepareForDelivery $prepareForDelivery
     */
    public function __construct(
        PrepareForDelivery $prepareForDelivery
    )
    {
       $this->prepareForDelivery = $prepareForDelivery;
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


        $referer[4] === 'reliquats' ?
            $this->prepareForDelivery->backOrderReady() :
            $this->prepareForDelivery->regularOrderReady($request->get('id'))
        ;

        return $responder();
    }
}