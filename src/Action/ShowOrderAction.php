<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 23:16
 */

namespace App\Action;


use App\Entity\InOrderProduct;
use App\Responder\ShowOrderResponder;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShowOrderAction
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * ShowOrderAction constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
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
       return
            $responder(
                $this->doctrine
                    ->getRepository(InOrderProduct::class)
                    ->findAllWithOrder($request->get('id'))
            )
       ;
    }
}