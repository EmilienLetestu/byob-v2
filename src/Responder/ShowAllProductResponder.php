<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 10:35
 */

namespace App\Responder;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowAllProductResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ShowAllProductResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param array $products
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(array $products)
    {
        return new Response(
            $this->twig->render('entity_listing.html.twig',[
                'products'        => $products,
                'listingTemplate' => 'listing/product_list.html.twig'
            ])
        );
    }
}