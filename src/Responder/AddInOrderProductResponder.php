<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 12:54
 */

namespace App\Responder;


use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class AddInOrderProductResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * AddInOrderProductResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param FormView $form
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(FormView $form): Response
    {
        return new Response(
            $this->twig->render('create_entity.html.twig',[
                'form'         => $form,
                'formTemplate' => 'form/in_order_product_form.html.twig'
            ])
        );
    }
}