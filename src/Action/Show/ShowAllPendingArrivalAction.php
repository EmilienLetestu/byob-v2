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
     *     "/arrivage/en-attente-de-validation/{filter1}/{filter2}",
     *     name="arrivalToValidate",
     *     requirements={"filter1" = "[a-z0-9-]+"},
     *     requirements={"filter2" = "\d+"}
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
            $request->get('filter1') === 'produit' ?
                $repository->findAllPendingWithProduct($request->get('filter2')) :
                (
                    $request->get('filter1') === 'mes-entrepots' ?
                        $repository->findArrivalInUserWarehouse($request->get('filter2')) :
                        $repository->findAllPendingFromWarehouse($request->get('filter2'))
                )
        );

    }
}