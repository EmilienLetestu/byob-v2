<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 02/08/2018
 * Time: 10:28
 */

namespace App\Action;


use App\Entity\Product;
use App\Responder\ShowProductResponder;

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
     * ShowProductAction constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
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
       return $responder(
           $this->doctrine->getRepository(Product::class)
           ->findProductWithId($request->get('id'))
       );
    }
}