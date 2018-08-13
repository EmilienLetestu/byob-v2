<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 12:15
 */

namespace App\Responder\Create;


use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class CreateProductResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * CreateProductResponder constructor.
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
               'form' => $form,
               'formTemplate' => 'form/product_form.html.twig'
           ])
       );
    }
}