<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 13:28
 */

namespace App\Action;


use App\Form\Type\WareHouseType;
use App\Handler\WareHouseFormHandler;

use App\Responder\CreateWarehouseResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CreateWarehouseAction
 * @package App\Action
 */
class CreateWarehouseAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var WareHouseFormHandler
     */
    private $formHandler;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * CreateWarehouseAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param WareHouseFormHandler $formHandler
     * @param SessionInterface $session
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        FormFactoryInterface  $formFactory,
        WareHouseFormHandler  $formHandler,
        SessionInterface      $session,
        UrlGeneratorInterface $urlGenerator
    )
    {
        $this->formFactory  = $formFactory;
        $this->formHandler  = $formHandler;
        $this->session      = $session;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @Route("/entrepot/ajouter", name="createWarehouse")
     *
     * @param Request $request
     * @param CreateWarehouseResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, CreateWarehouseResponder $responder): Response
    {
        $form = $this->formFactory
            ->create(WareHouseType::class)
            ->handleRequest($request)
        ;

        if($this->formHandler->handle($form))
        {
            $this->session->getFlashBag()
                ->add('success', 'Entrpôt ajouter avec succès')
            ;

            return new RedirectResponse(
                $this->urlGenerator->generate('dashboard')
            );
        }

        return $responder($form->createView());
    }


}