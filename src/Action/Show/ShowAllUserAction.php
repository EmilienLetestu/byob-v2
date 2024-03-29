<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 22:20
 */

namespace App\Action\Show;


use App\Entity\User;
use App\Responder\Show\ShowAllUserResponder;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowAllUserAction
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * ShowAllProductAction constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @Route("/utilisateur", name="userList")
     * @Route("/livreur", name="deliverymanList")
     *
     *
     * @param ShowAllUserResponder $responder
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, ShowAllUserResponder $responder): Response
    {
        $repo = $this->doctrine->getRepository(User::class);

        return $responder(
            $request->get('_route') === 'userList' ?
                $repo->findAllUser() : $repo->findUserWithRole('DELIVERYMAN')
        );
    }
}