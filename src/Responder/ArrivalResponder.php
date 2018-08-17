<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 16/08/2018
 * Time: 22:08
 */

namespace App\Responder;


use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ArrivalResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ArrivalResponder constructor.
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
            $this->twig->render('form/arrival_collection_form.html.twig',[
                'form' => $form
            ])
        );
    }
}
