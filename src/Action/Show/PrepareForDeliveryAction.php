<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 27/08/2018
 * Time: 10:29
 */

namespace App\Action\Show;


use App\Entity\InOrderProduct;
use App\Responder\PrepareForDeliveryResponder;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class PrepareForDeliveryAction
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
     * PrepareForDeliveryAction constructor.
     * @param EntityManagerInterface $doctrine
     * @param TokenStorageInterface $token
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        TokenStorageInterface  $token
    )
    {
        $this->doctrine = $doctrine;
        $this->token    = $token;
    }

    /**
     *  @Route(
     *     "preparation-pour-enlevement/commande/{id}",
     *     name="prepareForDelivery",
     *     requirements={"id" = "\d+"}
     * )
     *
     * @param Request $request
     * @param PrepareForDeliveryResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, PrepareForDeliveryResponder $responder): Response
    {
        $warehouse = $this->token->getToken()->getUser()->getUserInWarehouses();

        return
            $responder(
                $this->doctrine->getRepository(InOrderProduct::class)
                ->findReadyToPrepareInWarehouse(
                    $warehouse[0]->getWarehouse()->getId(),
                    $request->get('id'),
                    'en préparation'
                )
            )
        ;
    }
}
