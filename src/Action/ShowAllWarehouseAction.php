<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 23:12
 */

namespace App\Action;


use App\Entity\Warehouse;
use App\Responder\ShowAllWarehouseResponder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowAllWarehouseAction
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * ShowAllProductAction constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @Route("/warehouse", name="warehouseList")
     *
     * @param ShowAllWarehouseResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(ShowAllWarehouseResponder $responder): Response
    {
        return $responder(
            $this->doctrine
                ->getRepository(Warehouse::class)
                ->findAllWarehouse()
        );
    }
}