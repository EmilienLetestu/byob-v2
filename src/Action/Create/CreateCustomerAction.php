<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 12/08/2018
 * Time: 16:02
 */

namespace App\Action\Create;


use App\Form\Type\CreateCustomerType;
use App\Handler\CreateCustomerHandler;
use App\Responder\Create\CreateCustomerResponder;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Annotation\Route;

class CreateCustomerAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var CreateCustomerHandler
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
     * CreateCustomerAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param CreateCustomerHandler $handler
     * @param UrlGeneratorInterface $urlGenerator
     * @param SessionInterface $session
     */
    public function __construct(
        FormFactoryInterface  $formFactory,
        CreateCustomerHandler $handler,
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
     * @Route("/client/ajouter", name="createCustomer")
     *
     * @param Request $request
     * @param CreateCustomerResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, CreateCustomerResponder $responder): Response
    {
        $form = $this->formFactory
            ->create(CreateCustomerType::class)
            ->handleRequest($request)
        ;

        if($this->handler->handle($form))
        {
            $this->session->getFlashBag()
                ->add('success', 'Client ajouté avec succès')
            ;

            return new RedirectResponse(
                $this->urlGenerator->generate('customerList')
            );
        }

        return $responder(
            $form->createView()
        );
    }
}
