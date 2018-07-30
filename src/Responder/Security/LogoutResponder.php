<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 12:01
 */

namespace App\Responder\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class LogoutResponder
 * @package App\Responder\Security
 */
class LogoutResponder
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * LogoutResponder constructor.
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
            $this->urlGenerator->generate('login')
        );
    }
}