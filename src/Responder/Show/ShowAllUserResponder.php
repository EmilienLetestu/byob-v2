<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 22:21
 */

namespace App\Responder\Show;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowAllUserResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ShowAllProductResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     *
     * @param array $users
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(array $users): Response
    {
        return new Response(
            $this->twig->render('listing/user_list.html.twig',[
                'users'           => $users
            ])
        );
    }
}