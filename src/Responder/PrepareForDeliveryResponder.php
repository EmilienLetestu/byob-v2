<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 27/08/2018
 * Time: 10:30
 */

namespace App\Responder;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class PrepareForDeliveryResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * PrepareForDeliveryResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param array $toPrepare
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(array $inOrderProducts)
    {
        return new Response(
            $this->twig->render('prepare_for_delivery.html.twig',[
                'inOrderProducts' => $inOrderProducts
            ])
        );
    }
}
