<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 02/08/2018
 * Time: 00:10
 */

namespace App\Responder;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowArrivalInWarehouseResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ShowArrivalInWarehouseResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param array $pendingValidations
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(array $pendingValidations): Response
    {
        return new Response(
            $this->twig->render('entity_listing.html.twig',[
                'pendingValidations' => $pendingValidations,
                 'listingTemplate' => 'listing/pending_validation_list.html.twig'
            ])
        );
    }
}