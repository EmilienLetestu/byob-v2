<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 23/08/2018
 * Time: 12:18
 */

namespace App\Action;


use App\Entity\InOrderProduct;
use App\Entity\InStockProduct;
use App\Responder\ManuallyPreparedOrderResponder;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ManuallyPreparedOrderAction
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
     * ManuallyPreparedOrderAction constructor.
     * @param EntityManagerInterface $doctrine
     * @param SessionInterface $session
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        SessionInterface       $session
    )
    {
        $this->doctrine = $doctrine;
        $this->session  = $session;
    }

    /**
     * @Route(
     *     "/preparation-manuelle-commande/{id}/{data}",
     *     name = "manuallyPreparedOrder",
     *     requirements={"id" = "\d+"}
     * )
     *
     *
     * @param Request $request
     * @param ManuallyPreparedOrderResponder $responder
     * @return Response
     */
    public function __invoke(Request $request, ManuallyPreparedOrderResponder $responder): Response
    {
        $inOrders = $this->doctrine
            ->getRepository(InOrderProduct::class)
            ->findAllWithOrder($request->get('id'))
        ;

        $ids = [];
        $quantities = [];
        $ordered = [];

        foreach ($inOrders as $inOrder)
        {
            $ids[] = $inOrder->getProduct()->getId();
            $order = $inOrder->getOrder();
            $quantities[$inOrder->getProduct()->getId()] = $inOrder->getQuantity();
            $ordered[$inOrder->getProduct()->getId()] = $inOrder;

        }

        $order->setStatus('en préparation');

        $datas = explode('&',$request->get('data'));


        $products = [];
        foreach ($datas as $data){
            $productAndWarehouse = explode('_',$data);

            $products[$productAndWarehouse[0]] = $productAndWarehouse[1] ;
        }

        $inStock =  $this->doctrine
            ->getRepository(InStockProduct::class)
        ;

        foreach ($products as $key=>$value)
        {
            $prodId      = str_replace('p'," ",$key);
            $warehouseId = str_replace('w'," ",$value);
            $stock = $inStock->findProductStockInWarehouse($prodId, $warehouseId);

            $stock->setLevel(
                $stock->getLevel() - $quantities[$stock->getProduct()->getId()]
            );

            $ordered[$stock->getProduct()->getId()]->setWarehouse($stock->getWarehouse());
        }

        $this->doctrine->flush();

        return $responder();
    }
}