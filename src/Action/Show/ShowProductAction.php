<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 02/08/2018
 * Time: 10:28
 */

namespace App\Action\Show;


use App\Entity\Product;
use App\Helper\StockLevelHelper;
use App\Responder\Show\ShowProductResponder;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowProductAction
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * @var
     */
    private $stockLevel;

    /**
     * ShowProductAction constructor.
     * @param EntityManagerInterface $doctrine
     * @param StockLevelHelper $stockLevel
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        StockLevelHelper       $stockLevel
    )
    {
        $this->doctrine   = $doctrine;
        $this->stockLevel = $stockLevel;
    }

    /**
     * @Route(
     *     "/produit/{id}",
     *     name="productInfo",
     *     requirements={"id" = "\d+"}
     * )
     *
     * @param Request $request
     * @param ShowProductResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, ShowProductResponder $responder): Response
    {
        $product = $this->doctrine
            ->getRepository(Product::class)
            ->findProductWithId($request->get('id'))
        ;

       return $responder(
           $product,
           $this->stockLevel->productGlobalStock($product)
       );
    }
}