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
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ValidateArrivalResponder
{
    /**
     * @var UrlGeneratorInterface
     */
    private  $urlGenerator;

    /**
     * ValidateArrivalResponder constructor.
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @return Response
     */
    public function __invoke(): Response
    {
       return new RedirectResponse(
           $this->urlGenerator->generate('dashboard')
       );
    }
}