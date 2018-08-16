<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 10:31
 */

namespace App\Action\Create;


use App\Form\Type\CreateOrderType;
use App\Handler\CreateOrderHandler;
use App\Responder\Create\CreateOrderResponder;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CreateOrderAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var CreateOrderHandler
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
     * CreateOrderAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param CreateOrderHandler $handler
     * @param UrlGeneratorInterface $urlGenerator
     * @param SessionInterface $session
     */
    public function __construct(
        FormFactoryInterface  $formFactory,
        CreateOrderHandler    $handler,
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
     * @Route("/commande/commencer", name="createOrder")
     *
     * @param Request $request
     * @param CreateOrderResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, CreateOrderResponder $responder): Response
    {
        $form = $this->formFactory
            ->create(CreateOrderType::class)
            ->handleRequest($request)
        ;

        if($this->handler->handle($form))
        {
            $this->session->getFlashBag()
                ->add('success', 'Commande soumisse pour validation avec succès')
            ;

            return new RedirectResponse(
                $this->urlGenerator->generate('orderList')
            );
        }

        return $responder(
            $form->createView()
        );
    }
}