<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 23:16
 */

namespace App\Action\Show;


use App\Entity\InOrderProduct;
use App\Form\Type\OrderStatusType;
use App\Handler\OrderStatusHandler;
use App\Responder\Show\ShowOrderResponder;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ShowOrderAction
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    private $formFactory;

    private $handler;

    private $urlGenerator;

    private $session;

    /**
     * ShowOrderAction constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        FormFactoryInterface   $formFactory,
        OrderStatusHandler     $handler,
        UrlGeneratorInterface  $urlGenerator,
        SessionInterface       $session
    )
    {
        $this->doctrine     = $doctrine;
        $this->formFactory  = $formFactory;
        $this->handler      = $handler;
        $this->urlGenerator = $urlGenerator;
        $this->session      = $session;
    }

    /**
     * @Route(
     *     "/commande/{id}",
     *     name = "orderInfo",
     *     requirements={"id" = "\d+"}
     * )
     *
     * @param Request $request
     * @param ShowOrderResponder $responder
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, ShowOrderResponder $responder)
    {
       $inOrder =   $this->doctrine
           ->getRepository(InOrderProduct::class)
           ->findAllWithOrder($request->get('id'))
       ;

       $form = $this->formFactory
           ->create(OrderStatusType::class)
           ->handleRequest($request)
       ;

       if($this->handler->handle($form, $inOrder[0]->getOrder()))
       {
           $this->session->getFlashbag()
               ->add('success','Statut mis à jour avec succès')
           ;

           return new RedirectResponse(
               $this->urlGenerator->generate('orderInfo',
                   ['id' => $request->get('id')]
               )
           );
       }

       return
            $responder(
                $inOrder,
                $form->createView()
            )
       ;
    }
}