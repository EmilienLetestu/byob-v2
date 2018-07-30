<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 26/07/2018
 * Time: 09:04
 */

namespace App\Action;


use App\Responder\DashboardResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardAction

{
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
       return $responder('it works');
    }
}