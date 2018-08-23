<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 22/08/2018
 * Time: 18:12
 */

namespace App\Action;


use App\Entity\InOrderProduct;
use App\Entity\InStockProduct;
use App\Responder\EndOrderPreparationResponder;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class EndOrderPreparationAction
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * EndOrderPreparationResponder constructor.
     * @param EntityManagerInterface $doctrine
     * @param SessionInterface $session
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        SessionInterface $session
    )
    {
        $this->doctrine = $doctrine;
        $this->session  = $session;
    }

    /**
     * @Route(
     *     "/attribuer/commande/{id}/entrepot/{warehouseId}",
     *     name = "endPreparation",
     *     requirements={ "id" = "\d+" },
     *     requirements={ "warehouseId" = "\d+" }
     *
     * )
     *
     * @param Request $request
     * @param EndOrderPreparationResponder $responder
     * @return Response
     */
    public function __invoke(Request $request, EndOrderPreparationResponder $responder): Response
    {
            $inOrders = $this->doctrine
                ->getRepository(InOrderProduct::class)
                ->findAllWithOrder($request->get('id'))
            ;

            $ids = [];

            foreach ($inOrders as $inOrder)
            {
                $ids[] = $inOrder->getProduct()->getId();
                $order = $inOrder->getOrder();
            }

            $order->setStatus('en préparation');


            $inStocks = $this->doctrine
                ->getRepository(InStockProduct::class)
                ->findStockToBind($ids, $request->get('warehouseId'))
            ;

            $quantities = [];
            foreach ($inOrders as $inOrder)
            {
                $inOrder->setWarehouse($inStocks[0]->getWarehouse());
                $quantities[$inOrder->getProduct()->getId()] = $inOrder->getQuantity();
            }


            foreach($inStocks as $inStock)
            {
                 $inStock->setLevel(
                     $inStock->getLevel() - $quantities[$inStock->getProduct()->getId()]
                 );
            }

            $this->doctrine->flush();

            return $responder();
    }
}