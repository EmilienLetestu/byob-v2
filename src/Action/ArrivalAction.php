<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 16/08/2018
 * Time: 22:07
 */

namespace App\Action;



use App\Form\Type\ArrivalCollectionType;
use App\Handler\ArrivalCollectionHandler;
use App\Responder\ArrivalResponder;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Annotation\Route;

class ArrivalAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var ArrivalCollectionHandler
     */
    private $handler;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var SessionInterface
     */
    private $session;


    /**
     * ArrivalAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param ArrivalCollectionHandler $handler
     * @param UrlGeneratorInterface $urlGenerator
     * @param SessionInterface $session
     */
    public function __construct(
        FormFactoryInterface     $formFactory,
        ArrivalCollectionHandler $handler,
        UrlGeneratorInterface    $urlGenerator,
        SessionInterface         $session
    )
    {
        $this->formFactory  = $formFactory;
        $this->handler      = $handler;
        $this->urlGenerator = $urlGenerator;
        $this->session      = $session;
    }

    /**
     * @Route("/arrivage", name="arrival")
     *
     * @param Request $request
     * @param ArrivalResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, ArrivalResponder $responder): Response
    {
       $form = $this->formFactory
           ->create(ArrivalCollectionType::class)
           ->handleRequest($request)
       ;

       if($this->handler->handle($form))
       {
           $this->session->getFlashbag()
               ->add('success', 'Arrivage signaler pour validation avec succès')
           ;

           return new RedirectResponse(
               $this->urlGenerator->generate('dashboard')
           );
       }

       return $responder(
           $form->createView()
       );
    }
}
