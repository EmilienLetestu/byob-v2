<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 28/08/2018
 * Time: 16:44
 */

namespace App\Action\Show;


use App\Entity\InOrderProduct;
use App\Responder\Show\ShowAllBackOrderResponder;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Routing\Annotation\Route;

class ShowAllBackOrderAction
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * @var TokenStorageInterface
     */
    private $token;

    /**
     * @var SessionInterface
     */
    private $session;


    /**
     * ShowAllBackOrderAction constructor.
     * @param EntityManagerInterface $doctrine
     * @param TokenStorageInterface $token
     * @param SessionInterface $session
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        TokenStorageInterface  $token,
        SessionInterface       $session
    )
    {
        $this->doctrine = $doctrine;
        $this->token    = $token;
        $this->session  = $session;
    }

    /**
     * @Route("/reliquats-a-preparer", name="backorderList")
     *
     * @param ShowAllBackOrderResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(ShowAllBackOrderResponder $responder):Response
    {
        $repo      = $this->doctrine->getRepository(InOrderProduct::class);
        $user      = $this->token->getToken()->getUser();
        $warehouse = $user->getUserInWarehouses();

        return
            $responder(
                $user->getRole() === 'LOGISTIC' ?
                    $repo->findAllWithBackOrderReady() :
                    $repo->findBackOrderToPrepare($warehouse[0]->getWarehouse()->getId())

            )
        ;
    }
}
