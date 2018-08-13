<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 13/08/2018
 * Time: 11:49
 */

namespace App\Responder\Show;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowWarehouseStockResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ShowWarehouseResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param array $inStockProducts
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(array $inStockProducts): Response
    {
        return new Response(
            $this->twig->render('warehouse_stock.html.twig',[
                'inStockProducts' => $inStockProducts
            ])
        );
    }
}