<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 10:35
 */

namespace App\Action\Show;


use App\Entity\Product;
use App\Responder\Show\ShowAllProductResponder;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Routing\Annotation\Route;

class ShowAllProductAction
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
     * @Route("/produit", name="productList")
     *
     * @param ShowAllProductResponder $responder
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(ShowAllProductResponder $responder)
    {

        return
            $responder(
                $this->doctrine
                    ->getRepository(Product::class)
                    ->findAllProduct()
            )
        ;
    }
}