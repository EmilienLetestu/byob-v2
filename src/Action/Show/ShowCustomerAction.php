<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 09/08/2018
 * Time: 09:03
 */

namespace App\Action\Show;


use App\Entity\Customer;
use App\Responder\Show\ShowCustomerResponder;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowCustomerAction
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * ShowCustomerAction constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @Route(
     *     "/client/{id}",
     *     name="customerInfo",
     *     requirements={"id" = "\d+"}
     * )
     *
     * @param Request $request
     * @param ShowCustomerResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, ShowCustomerResponder $responder): Response
    {
        return $responder(
            $this->doctrine
            ->getRepository(Customer::class)
            ->findCustomerWithId($request->get('id'))
        );
    }
}
