<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 22:09
 */

namespace App\Responder\Show;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowAllOrderResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ShowAllOrderResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param array $orders
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(array $orders): Response
    {
        return new Response(
            $this->twig->render('listing/order_listing.html.twig',[
                'orders' => $orders
            ])
        );
    }
}
