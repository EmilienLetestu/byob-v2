<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 13:27
 */

namespace App\Responder\Create;


use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class CreateWarehouseResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * CreateWarehouseResponder constructor.
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
           $this->twig->render('create_Entity.html.twig',[
               'form' => $form,
               'formTemplate' => 'form/warehouse_form.html.twig'
           ])
       );
    }
}