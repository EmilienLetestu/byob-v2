<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 11:33
 */

namespace App\Responder;


use App\Entity\Product;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ProductArrivalResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ProductArrivalResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param FormView $form
     * @param Product $product
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(FormView $form, Product $product): Response
    {
        return new Response(
            $this->twig->render('arrival.html.twig',[
                'form' => $form,
                'formTemplate' => 'form/arrival_form.html.twig',
                'product'      => $product
            ])
        );
    }
}