<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 12/08/2018
 * Time: 10:54
 */

namespace App\Responder\Create;


use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class CreateRefDetailResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * CreateRefDetailResponder constructor.
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
    public function __invoke(FormView $form)
    {
        return new Response(
            $this->twig->render('create_entity.html.twig',[
                'form' => $form,
                'formTemplate' => 'form/ref_detail_form.html.twig'
            ])
        );
    }
}