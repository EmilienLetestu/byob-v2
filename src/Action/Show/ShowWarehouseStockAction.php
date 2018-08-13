<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 13/08/2018
 * Time: 11:48
 */

namespace App\Action\Show;


use App\Entity\InStockProduct;
use App\Responder\Show\ShowWarehouseStockResponder;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShowWarehouseStockAction
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * ShowWarehouseStockAction constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @Route(
     *     "/{warehouseName}/{id}/stock",
     *      name="warehouseStock",
     *     requirements={ "warehouseName" = "[a-z0-9-]+" },
     *     requirements={ "id" = "\d+" }
     * )
     *
     * @param Request $request
     * @param ShowWarehouseStockResponder $responder
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, ShowWarehouseStockResponder $responder)
    {
       return
           $responder(
               $this->doctrine
                   ->getRepository(InStockProduct::class)
                   ->findStockInWarehouse($request->get('id'))
           )
       ;
    }
}