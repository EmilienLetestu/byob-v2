<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 27/08/2018
 * Time: 12:22
 */

namespace App\Responder;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class OrderIsAssembledResponder
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * OrderIsAssembledResponder constructor.
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }


    /**
     * @return RedirectResponse
     */
    public function __invoke(): RedirectResponse
    {
        return new RedirectResponse(
            $this->urlGenerator->generate('dashboard')
        );
    }
}