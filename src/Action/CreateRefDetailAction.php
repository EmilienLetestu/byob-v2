<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 12/08/2018
 * Time: 10:54
 */

namespace App\Action;


use App\Form\Type\RefDetailType;
use App\Handler\RefDetailHandler;
use App\Responder\CreateRefDetailResponder;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Annotation\Route;

class CreateRefDetailAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var RefDetailHandler
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
     * CreateRefDetailAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param RefDetailHandler $handler
     * @param UrlGeneratorInterface $urlGenerator
     * @param SessionInterface $session
     */
    public function __construct(
        FormFactoryInterface  $formFactory,
        RefDetailHandler      $handler,
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
     * @Route(
     *     "/produit/reglage/ajouter/{constKey}",
     *     name="addProductRefDetail",
     *     requirements={"constKey" = "[a-z]{3,25}"}
     * )
     *
     * @param Request $request
     * @param CreateRefDetailResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, CreateRefDetailResponder $responder): Response
    {
       $form = $this->formFactory
           ->create(RefDetailType::class)
           ->handleRequest($request)
       ;

       if ($this->handler->handle($form, $request->get('constKey')))
       {
           $this->session->getFlashBag()
               ->add('success', 'Ajouté avec succès');

           return new RedirectResponse(
               $this->urlGenerator->generate('dashboard')
           );
       }

       return $responder(
           $form->createView()
       );
    }
}
