<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 23/08/2018
 * Time: 12:18
 */

namespace App\Action;

use App\Responder\ManuallyPreparedOrderResponder;
use App\Services\ManuallyPreparedOrder;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ManuallyPreparedOrderAction
{
    /**
     * @var EntityManagerInterface
     */
    private $manually;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * ManuallyPreparedOrderAction constructor.
     * @param ManuallyPreparedOrder $manually
     * @param SessionInterface $session
     */
    public function __construct(
        ManuallyPreparedOrder $manually,
        SessionInterface       $session
    )
    {
        $this->manually = $manually;
        $this->session  = $session;
    }

    /**
     * @Route(
     *     "/preparation-manuelle-commande/{id}/{data}",
     *     name = "manuallyPreparedOrder",
     *     requirements={"id" = "\d+"}
     * )
     *
     *
     * @param Request $request
     * @param ManuallyPreparedOrderResponder $responder
     * @return Response
     */
    public function __invoke(Request $request, ManuallyPreparedOrderResponder $responder): Response
    {

        $this->manually->assignToStock(
            $this->session->get('inOrder'),
            $this->session->get('inOrderDto'),
            $request->get('data')
        );

        $this->session->remove('inOrder');
        $this->session->remove('inOrderDto');


        return $responder();
    }
}