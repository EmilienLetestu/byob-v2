<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 12/08/2018
 * Time: 20:30
 */

namespace App\Action\Add;


use App\Form\Type\AddPersonContactType;
use App\Handler\AddCustomerContactHandler;
use App\Responder\Add\AddContactResponder;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AddContactAction
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
    private $session;

    /**
     * @var
     */
    private $urlGenrator;

    /**
     * AddContactAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param AddCustomerContactHandler $handler
     * @param SessionInterface $session
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        FormFactoryInterface      $formFactory,
        AddCustomerContactHandler $handler,
        SessionInterface          $session,
        UrlGeneratorInterface     $urlGenerator
    )
    {
        $this->formFactory  = $formFactory;
        $this->handler      = $handler;
        $this->session      = $session;
        $this->urlGenrator  = $urlGenerator;
    }

    /**
     * @Route(
     *     "/nouveau-contact/client/{id}",
     *      name="addContactToCustomer",
     *      requirements={"id" = "\d+"}
     * )
     *
     * @param AddContactResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, AddContactResponder $responder): Response
    {
        $form = $this->formFactory
            ->create(AddPersonContactType::class)
            ->handleRequest($request)
        ;

        if($this->handler->handle($form, $request->get('id')))
        {
            $this->session->getFlashBag()
                ->add('success','Contact ajouté avec succès')
            ;

            return new RedirectResponse(
                $this->urlGenrator->generate('customerInfo',
                    ['id' => $request->get('id')]
                )
            );
        }

        return $responder($form->createView());
    }
}