<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 11:30
 */

namespace App\Action;


use App\Entity\Product;
use App\Form\Type\ProductArrivalType;
use App\Handler\ProductArrivalHandler;
use App\Responder\ProductArrivalResponder;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProductArrivalAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;


    private $formHandler;

    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;


    public function __construct(
        FormFactoryInterface    $formFactory,
        ProductArrivalHandler          $formHandler,
        EntityManagerInterface  $doctrine,
        SessionInterface        $session,
        UrlGeneratorInterface   $urlGenerator
    )
    {
        $this->formFactory = $formFactory;
        $this->formHandler = $formHandler;
        $this->doctrine    = $doctrine;
        $this->session     = $session;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     *  * * @Route(
     *     "/arrivage/produit/{id}",
     *     name = "productArrival",
     *     requirements={"id" = "\d+"}
     * )
     *
     * @param Request $request
     * @param ProductArrivalResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, ProductArrivalResponder $responder): Response
    {
        $product = $this->doctrine
            ->getRepository(Product::class)
            ->findProductWithId($request->get('id'))
        ;

        $form = $this->formFactory
            ->create(ProductArrivalType::class)
            ->handleRequest($request)

        ;

        if($this->formHandler->handle($form, $product))
        {
            $this->session->getFlashBag()
                ->add('success', 'Arrivage signaler pour validation avec succès')
            ;

            return new RedirectResponse(
                $this->urlGenerator->generate('dashboard')
            );
        }


        return $responder(
            $form->createView(),
            $product
        );
    }
}