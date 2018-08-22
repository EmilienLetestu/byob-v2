<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 22/08/2018
 * Time: 11:56
 */

namespace App\Action;


use App\Entity\InOrderProduct;
use App\Entity\InStockProduct;
use App\Responder\PrepareOrderResponder;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PrepareOrderAction
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * PrepareOrderAction constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
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
       $inOrders = $this->doctrine
           ->getRepository(InOrderProduct::class)
           ->findAllWithOrder($request->get('id'))
       ;

        $productId  = [];


       foreach ($inOrders as $inOrder)
       {
           $productId[] = $inOrder->getProduct()->getId();
           $quantities[$inOrder->getProduct()->getId()] = $inOrder->getQuantity();
       }

       $inStocks =  $this->doctrine
           ->getRepository(InStockProduct::class)
           ->findWithProductAndAtLeast($productId);

        $warehouseName = [];
        $stock = [];
        $products = [];
        $missing = [];

       //1- try to find a warehouse that contains all the product
        // make an array which contains all the warehouses
       foreach ($inStocks as $key => $inStock)
       {
           $stock[] = $inStock->getWarehouse()->getId();

           $warehouseName[$inStock->getWarehouse()->getId()] = $inStock->getWarehouse();

           $products[] = $inStock->getProduct()->getId();

           $productModel[$inStock->getProduct()->getId()] = $inStock->getProduct();

       }

       // count the number  of times each warehouse appears
        $warehouse = array_count_values($stock);


       //compare warehouses appearance pattern to the number of product ordered
        $matchingWarehouses = [];
       if(in_array(count($productId), $warehouse)){
           $r[] = array_search(count($productId), $warehouse);

           foreach ($r as $key=>$value)
           {
               $matchingWarehouses[] = $warehouseName[$value];
           }
       }

       //2-check for missing product
        $prod = array_count_values($products);


        //count the number  of times distinct products are found and compare with products in order
        if(count($prod) < count($productId))
        {
            foreach ($productId as $id)
            {
                if(!array_key_exists($id, $productModel))
                {

                   $missing[] = $this->doctrine
                       ->getRepository(InStockProduct::class)
                       ->findWithStockedProduct($id, $quantities[$id])
                    ;
                }
            }
        }

       return $responder(
           $inStocks,
           $quantities,
           $matchingWarehouses,
           $missing
       );
    }
}