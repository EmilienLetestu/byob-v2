<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 10:31
 */

namespace App\Responder\Create;


use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class CreateOrderResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * CreateOrderResponder constructor.
     * @param Environment $twig
     */
    public  function __construct(Environment $twig)
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
           $this->twig->render('form/order_form.html.twig',[
               'form' => $form
           ])
       );
    }
}