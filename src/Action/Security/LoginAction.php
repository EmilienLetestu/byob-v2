<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 11:20
 */

namespace App\Action\Security;


use App\Responder\Security\LoginResponder;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;


class LoginAction
{
    /**
     * @var AuthorizationCheckerInterface
     */
     private $authCheck;

    /**
     * @var UrlGeneratorInterface
     */
     private $urlGenerator;

    /**
     * LoginAction constructor.
     * @param AuthorizationCheckerInterface $authCheck
     * @param UrlGeneratorInterface $urlGenerator
     */
     public function __construct(
         AuthorizationCheckerInterface $authCheck,
         UrlGeneratorInterface $urlGenerator
     )
     {
         $this->authCheck   = $authCheck;
         $this->urlGenerator = $urlGenerator;
     }

    /**
     * @Route("/", name = "login")
     *
     * @param Request $request
     * @param AuthenticationUtils $utils
     * @param LoginResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
     public function __invoke(Request $request, AuthenticationUtils $utils , LoginResponder $responder): Response
     {
         if($this->authCheck->isGranted('IS_AUTHENTICATED_REMEMBERED'))
         {
             return new RedirectResponse(
                 $this->urlGenerator->generate('dashboard')
             );
         }

         dump($utils->getLastAuthenticationError());


         return $responder(
             $utils->getLastUsername(),
             $utils->getLastAuthenticationError()
         );
     }
}