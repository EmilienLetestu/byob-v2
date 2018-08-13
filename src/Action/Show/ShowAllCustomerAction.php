<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 07/08/2018
 * Time: 21:17
 */

namespace App\Action\Show;

use App\Entity\Customer;
use App\Responder\Show\ShowAllCustomerResponder;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ShowAllCustomerAction
 * @package App\Action
 */
class ShowAllCustomerAction
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;


    /**
     * ShowAllCustomerAction constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @Route("/client", name="customerList")
     *
     * @param ShowAllCustomerResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(ShowAllCustomerResponder $responder): Response
    {
       return
           $responder(
               $this->doctrine
                   ->getRepository(Customer::class)
                   ->findAllCustomer()
           )
       ;
    }
}
