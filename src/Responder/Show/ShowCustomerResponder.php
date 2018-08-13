<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 09/08/2018
 * Time: 09:04
 */

namespace App\Responder\Show;


use App\Entity\Customer;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowCustomerResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ShowCustomerResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param Customer $customer
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Customer $customer): Response
    {
        return new Response(
            $this->twig->render('customer_info.html.twig',[
                'customer' => $customer
            ])
        );
    }
}
