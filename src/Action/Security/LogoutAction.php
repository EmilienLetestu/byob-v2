<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 12:01
 */

namespace App\Action\Security;

use App\Responder\Security\LogoutResponder;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LogoutAction
 * @package App\Action\Security
 */
class LogoutAction
{
    /**
     * @var SessionInterface
     */
    private $session;
    /**
     * LogoutAction constructor.
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route(
     *     "/logout",
     *     name="logout")
     *
     * @param LogoutResponder $responder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function __invoke(LogoutResponder $responder): RedirectResponse
    {
        $this->session->invalidate();
        return $responder();
    }
}