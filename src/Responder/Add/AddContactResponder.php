<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 12/08/2018
 * Time: 20:30
 */

namespace App\Responder\Add;


use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class AddContactResponder
{
    /**
     * @var Environment
     */
    private  $twig;

    /**
     * AddContactResponder constructor.
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
    public function __invoke(FormView $form)
    {
        return new Response(
            $this->twig->render('create_entity.html.twig',[
                'form' => $form,
                'formTemplate' => 'form/add_contact.html.twig'
            ])
        );
    }
}