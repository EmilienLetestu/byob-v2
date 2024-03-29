<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 23:16
 */

namespace App\Responder\Show;

use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowOrderResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ShowOrderResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param array $inOrderProducts
     * @param FormView $form
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(array $inOrderProducts, FormView $form): Response
    {
        return new Response(
            $this->twig->render('info/order_info.html.twig',[
                'inOrderProducts' => $inOrderProducts,
                'form'            => $form
            ])
        );
    }

}