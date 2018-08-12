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
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardAction

{
    private $doctrine;

    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
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

       return $responder(
           $this->doctrine
           ->getRepository(Product::class)
           ->findFirstProduct()
       );
    }
}