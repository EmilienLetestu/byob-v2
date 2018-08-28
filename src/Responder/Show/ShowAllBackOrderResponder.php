<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 28/08/2018
 * Time: 17:07
 */

namespace App\Responder\Show;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowAllBackOrderResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ShowAllBackOrderResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
       $this->twig = $twig;
    }

    /**
     * @param array $backOrders
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(array $backOrders): Response
    {
        return new Response(
            $this->twig->render('listing/back_order_listing.html.twig',[
                'backOrders' => $backOrders
            ])
        );
    }
}