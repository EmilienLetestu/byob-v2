<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 06/08/2018
 * Time: 22:48
 */

namespace App\Responder;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class ValidateArrivalResponder
{
    /**
     * @param string $referer
     * @return Response
     */
    public function __invoke(string $referer): Response
    {
       return new RedirectResponse($referer);
    }
}