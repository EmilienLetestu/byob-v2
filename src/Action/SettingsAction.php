<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 14/08/2018
 * Time: 11:02
 */

namespace App\Action;


use App\Entity\Product;
use App\Responder\SettingsResponder;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SettingsAction
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * SettingsAction constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(
        EntityManagerInterface $doctrine
    )
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @Route("/reglages", name = "settings")
     *
     * @param SettingsResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(SettingsResponder $responder): Response
    {
        return
            $responder(
                $this->doctrine
                    ->getRepository(Product::class)
                    ->findFirstProduct()
        );
    }
}