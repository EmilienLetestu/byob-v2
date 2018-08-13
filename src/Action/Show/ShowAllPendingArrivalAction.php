<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 02/08/2018
 * Time: 00:09
 */

namespace App\Action\Show;


use App\Entity\PendingValidationStock;
use App\Responder\Show\ShowAllPendingArrivalResponder;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowAllPendingArrivalAction
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * ShowArrivalInWarehouseAction constructor.
     * @param EntityManagerInterface $doctrine
     */
    public  function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @Route(
     *     "/produits/en-attente-de-validation/{warehouseName}/{id}",
     *     name="arrivalInWarehouse",
     *     requirements={"warehouseName" = "[a-z0-9-]+"},
     *     requirements={"id" = "\d+"}
     * )
     *
     * @Route(
     *     "/{model}/en-attente-de-validation/{id}",
     *     name="arrival",
     *     requirements={"model" = "[a-z0-9-]+"},
     *     requirements={"id" = "\d+"}
     * )
     *
     * @param Request $request
     * @param ShowAllPendingArrivalResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, ShowAllPendingArrivalResponder $responder): Response
    {
        $repository = $this->doctrine
            ->getRepository(PendingValidationStock::class)
        ;
        
        return $responder(
            $request->attributes->get('_route') === 'arrival' ?
                $repository->findAllPendingWithProduct($request->get('id')) :
                $repository->findAllPendingFromWarehouse($request->get('id'))
        );

    }
}