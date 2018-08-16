<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 26/07/2018
 * Time: 09:04
 */

namespace App\Responder;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class DashboardResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * HomeResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param array $data
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(array $data): Response
    {
        return new Response(
            $this->twig->render('dashboard.html.twig',[
                'data'     => $data
            ])
        );
    }
}