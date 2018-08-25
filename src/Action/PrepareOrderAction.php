<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 22/08/2018
 * Time: 11:56
 */

namespace App\Action;


use App\Responder\PrepareOrderResponder;

use App\DTO\OrderPreparationDTO;
use App\Services\OrderPreparation;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PrepareOrderAction
{
    /**
     * @var OrderPreparation
     */
    private $orderPreparation;

    /**
     * @var OrderPreparationDTO
     */
    private $preparationDto;


    /**
     * PrepareOrderAction constructor.
     * @param OrderPreparation $orderPreparation
     */
    public function __construct(
        OrderPreparation       $orderPreparation
    )
    {

        $this->orderPreparation = $orderPreparation;
        $this->preparationDto     = new OrderPreparationDTO();
    }

    /**
     * @Route(
     *     "/preparation-commande/{id}",
     *     name = "prepareOrder",
     *     requirements = {"id" = "\d+"}
     * )
     *
     * @param Request $request
     * @param PrepareOrderResponder $responder
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, PrepareOrderResponder $responder)
    {
        $this->orderPreparation->getAllInOrderAndInitializeSearch(
            $request->get('id'), $this->preparationDto
        );

        $inStocks = $this->orderPreparation
            ->getStocksMatchingOrderedQuantities(
                $this->preparationDto->getProductId(), $request->get('id')
            )
        ;

        $this->orderPreparation->getBestSolutions(
            $inStocks, $this->preparationDto ,$request->get('id')
        );


       return $responder(
           $inStocks,
           $this->preparationDto->getQuantities(),
           $this->preparationDto->getMatchingWarehouses(),
           $this->preparationDto->getMissing()
       );
    }
}