<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 12:15
 */

namespace App\Action;


use App\Form\Type\ProductType;

use App\Handler\ProductFormHandler;
use App\Responder\CreateProductResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CreateProductAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var
     */
    private $handler;

    /**
     * @var
     */
    private $urlGenerator;

    /**
     * @var
     */
    private $session;


    /**
     * CreateProductAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param ProductFormHandler $handler
     * @param UrlGeneratorInterface $urlGenerator
     * @param SessionInterface $session
     */
    public function __construct(
        FormFactoryInterface  $formFactory,
        ProductFormHandler    $handler,
        UrlGeneratorInterface $urlGenerator,
        SessionInterface      $session

    )
    {
        $this->formFactory  = $formFactory;
        $this->handler      = $handler;
        $this->urlGenerator = $urlGenerator;
        $this->session      = $session;
    }

    /**
     * @Route("/produit/ajouter", name = "createProduct")
     *
     * @param Request $request
     * @param CreateProductResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, CreateProductResponder $responder): Response
    {
       $form = $this->formFactory
           ->create(ProductType::class)
           ->handleRequest($request)
       ;

       if($this->handler->handle($form))
       {
           $this->session->getFlashBag()
               ->add('success', 'Produit ajouter avec succès')
           ;

           return new RedirectResponse(
               $this->urlGenerator->generate('dashboard')
           );
       }

       return $responder($form->createView());
    }
}