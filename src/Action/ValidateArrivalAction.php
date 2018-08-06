<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 06/08/2018
 * Time: 22:47
 */

namespace App\Action;


use App\Responder\ValidateArrivalResponder;
use App\Services\ArrivalValidation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Routing\Annotation\Route;

class ValidateArrivalAction
{
    private $token;

    private $arrivalValidation;

    public function __construct(
        TokenStorageInterface $token,
        ArrivalValidation     $arrivalValidation
    )
    {
        $this->token = $token;
        $this->arrivalValidation = $arrivalValidation;
    }

    /**
     * @Route(
     *     "valider/arrivage/{pendingId}",
     *      name = "validateArrival",
     *     requirements={"pendingId" = "\d+"}
     * )
     * @Route(
     *     "refuser/arrivage/{pendingId}",
     *      name = "rejectArrival",
     *      requirements={"pendingId" = "\d+"}
     * )
     *
     * @param Request $request
     */
    public function __invoke(Request $request, ValidateArrivalResponder $responder)
    {
        $user = $this->token->getToken()->getUser();
        $pendingId = $request->get('pendingId');
        $route    = $request->attributes->get('_route');

        $this->arrivalValidation->ValidateOrReject($route, $pendingId, $user);

        return $responder();
    }
}