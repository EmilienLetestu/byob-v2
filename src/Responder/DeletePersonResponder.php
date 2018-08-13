<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 13/08/2018
 * Time: 09:55
 */

namespace App\Responder;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;


class DeletePersonResponder
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