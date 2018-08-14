<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 26/07/2018
 * Time: 09:04
 */

namespace App\Action;


use App\Entity\Product;
use App\Responder\DashboardResponder;
use App\Services\UserDashboard;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class DashboardAction

{
    /**
     * @var UserDashboard
     */
    private $userDashBoard;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * DashboardAction constructor.
     * @param UserDashboard $userDashboard
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        UserDashboard          $userDashboard,
        TokenStorageInterface  $tokenStorage
    )
    {
        $this->userDashBoard = $userDashboard;
        $this->tokenStorage  = $tokenStorage;
    }

    /**
     * @Route("/dashboard", name = "dashboard")
     *
     * @param DashboardResponder $responder
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(DashboardResponder $responder): Response
    {
       return
           $responder(
               $this->userDashBoard->getUserDashboard(
                   $this->tokenStorage->getToken()->getUser()->getRole()
           )
       );
    }
}