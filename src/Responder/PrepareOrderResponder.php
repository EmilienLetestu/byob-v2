<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 22/08/2018
 * Time: 11:57
 */

namespace App\Responder;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class PrepareOrderResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * PrepareOrderResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param array $results
     * @param array $orderedQuantities
     * @param array $matchingWarehouses
     * @param array $missing
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(array $results, array $orderedQuantities, array $matchingWarehouses, array $missing): Response
    {
       return new Response(
           $this->twig->render('prepare_order.html.twig',[
               'results'            => $results,
               'orderedQuantity'    => $orderedQuantities,
               'matchingWarehouses' => $matchingWarehouses,
               'missing'            => $missing
           ])
       );
    }
}