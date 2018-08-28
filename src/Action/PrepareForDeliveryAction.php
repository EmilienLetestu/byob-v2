<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 27/08/2018
 * Time: 10:29
 */

namespace App\Action;


use App\Entity\InOrderProduct;
use App\Responder\PrepareForDeliveryResponder;
use App\Services\PreparationList;
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
     * @var
     */
    private $preparationList;

    /**
     * PrepareForDeliveryAction constructor.
     * @param EntityManagerInterface $doctrine
     * @param TokenStorageInterface $token
     * @param PreparationList $preparationList
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        TokenStorageInterface  $token,
        PreparationList        $preparationList
    )
    {
        $this->doctrine = $doctrine;
        $this->token    = $token;
        $this->preparationList = $preparationList;
    }

    /**
     *  @Route(
     *     "preparation-pour-enlevement/commande/{id}",
     *     name="prepareForDelivery",
     *     requirements={"id" = "\d+"}
     * )
     *
     * @Route(
     *      "preparation-pour-enlevement/reliquats/commande/{id}",
     *     name="prepareBackOrderForDelivery",
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
        $userInWarehouse   = $this->token->getToken()->getUser()->getUserInWarehouses();
        $warehouseId       = $userInWarehouse[0]->getWarehouse()->getId();
        $orderId           = $request->get('id');

        $repo = $this->doctrine->getRepository(InOrderProduct::class);

        return
            $responder(
                $request->get('_route') === 'prepareForDelivery' ?

                    $this->preparationList->regularOrderList($repo, $warehouseId, $orderId) :
                    $this->preparationList->backOrderList($repo, $warehouseId, $orderId)
            )
        ;
    }
}
