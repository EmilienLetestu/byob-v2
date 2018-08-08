<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 16:00
 */

namespace App\Action;

use App\Responder\EndOrderResponder;
use App\Services\SaveInSessionOrder;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EndOrderAction
 * @package App\Action
 */
class EndOrderAction
{
    /**
     * @var SaveInSessionOrder
     */
    private $saveOrder;

    /**
     * EndOrderAction constructor.
     * @param SaveInSessionOrder $saveOrder
     */
    public  function __construct(SaveInSessionOrder $saveOrder)
    {
        $this->saveOrder = $saveOrder;
    }

    /**
     * @Route("/commande/finaliser", name = "endOrder")
     *
     * @param EndOrderResponder $responder
     * @return Response
     */
    public function __invoke(EndOrderResponder $responder):Response
    {
        $this->saveOrder->saveOrderFromSession();

        return $responder();
    }
}
