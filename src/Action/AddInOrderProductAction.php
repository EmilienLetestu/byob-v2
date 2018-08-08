<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 12:54
 */

namespace App\Action;


use App\Form\Type\InOrderProductType;
use App\Handler\InOrderProductHandler;
use App\Responder\AddInOrderProductResponder;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Annotation\Route;

class AddInOrderProductAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var InOrderProductHandler
     */
    private $handler;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * AddInOrderProductAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param InOrderProductHandler $handler
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        FormFactoryInterface  $formFactory,
        InOrderProductHandler $handler,
        UrlGeneratorInterface $urlGenerator
    )
    {
        $this->formFactory = $formFactory;
        $this->handler     = $handler;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @Route("/commande/ajouter-produit", name = "addProductToOrder")
     *
     * @param Request $request
     * @param AddInOrderProductResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, AddInOrderProductResponder $responder): Response
    {
       $form = $this->formFactory
           ->create(InOrderProductType::class)
           ->handleRequest($request)
       ;

       if($this->handler->handle($form))
       {
           return new RedirectResponse(
               $this->urlGenerator->generate('addProductToOrder')
           );
       }

       return $responder(
           $form->createView()
       );
    }
}