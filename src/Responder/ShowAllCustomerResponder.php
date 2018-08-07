<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 07/08/2018
 * Time: 21:17
 */

namespace App\Responder;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowAllCustomerResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ShowAllCustomerResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param array $customers
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(array $customers): Response
    {
        return new Response(
            $this->twig->render('entity_listing.html.twig',[
                'customers'       => $customers,
                'listingTemplate' => 'listing/customer_list.html.twig'
            ])
        );
    }

}