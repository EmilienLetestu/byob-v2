<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 19:02
 */

namespace App\Action\Create;

use App\Form\Type\CreateUserType;
use App\Handler\UserFormHandler;
use App\Responder\Create\CreateUserResponder;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


/**
 * Class CreateUserAction
 * @package App\Action
 */
class CreateUserAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UserFormHandler
     */
    private $handler;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;


    /**
     * CreateUserAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param UserFormHandler $handler
     * @param SessionInterface $session
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        FormFactoryInterface  $formFactory,
        UserFormHandler       $handler,
        SessionInterface      $session,
        UrlGeneratorInterface $urlGenerator
    )
    {
        $this->formFactory  = $formFactory;
        $this->handler      = $handler;
        $this->session      = $session;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @Route("/utilisateur/ajouter", name="createUser")
     *
     * @param Request $request
     * @param CreateUserResponder $responder
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, CreateUserResponder $responder): Response
    {
        $form = $this->formFactory
            ->create(CreateUserType::class)
            ->handleRequest($request)
        ;

        if($this->handler->handle($form))
        {
            $this->session->getFlashBag()
                ->add('success', 'Utilisateur ajouter avec succès')
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