<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 23:59
 */

namespace App\Responder\Create;


use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class CreateUserResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * CreateUserResponder constructor.
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
           $this->twig->render('form/user_form.html.twig',[
               'form' => $form
           ])
       );
    }
}