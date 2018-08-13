<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 02/08/2018
 * Time: 10:30
 */

namespace App\Responder\Show;


use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowProductResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ShowProductResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param Product $product
     * @param int $stockLevel
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Product $product, int $stockLevel): Response
    {
        return new Response(
            $this->twig->render('produc_info.html.twig',[
                'product'    => $product,
                'stockLevel' => $stockLevel
            ])
        );
    }
}