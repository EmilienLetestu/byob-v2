<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 02/08/2018
 * Time: 00:09
 */

namespace App\Action;


use App\Entity\PendingValidationStock;
use App\Responder\ShowArrivalInWarehouseResponder;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowArrivalInWarehouseAction
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
     *     "/produits/en-attente-de-validation/{warehouseId}",
     *     name="arrivalInWarehouse",
     *     requirements={"warehouseId" = "\d+"}
     *
     * )
     *
     * @param Request $request
     * @param ShowArrivalInWarehouseResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, ShowArrivalInWarehouseResponder $responder): Response
    {
        return $responder(
            $this->doctrine
                ->getRepository(PendingValidationStock::class)
                ->findAllPendingFromWarehouse($request->get('warehouseId'))

        );
    }
}