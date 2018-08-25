<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 22/08/2018
 * Time: 18:12
 */

namespace App\Action;

use App\Responder\AutomatizedPreparationResponder;

use App\Services\AutomatizedPreparation;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class AutomatizedPreparationAction
{
    /**
     * @var EntityManagerInterface
     */
    private $automatized;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * AutomatizedPreparationAction constructor.
     * @param AutomatizedPreparation $automatized
     * @param SessionInterface $session
     */
    public function __construct(
        AutomatizedPreparation $automatized,
        SessionInterface $session
    )
    {
        $this->automatized = $automatized;
        $this->session     = $session;
    }

    /**
     * @Route(
     *     "/attribuer/commande/{id}/entrepot/{warehouseId}",
     *     name = "endPreparation",
     *     requirements={ "id" = "\d+" },
     *     requirements={ "warehouseId" = "\d+" }
     * )
     *
     * @param Request $request
     * @param AutomatizedPreparationResponder $responder
     * @return Response
     */
    public function __invoke(Request $request, AutomatizedPreparationResponder $responder): Response
    {
        $this->automatized->assignToStock(
            $this->session->get('inOrder'),
            $this->session->get('inOrderDto'),
            $request->get('warehouseId')
        );

        $this->session->remove('inOrder');
        $this->session->remove('inOrderDto');

        return $responder();
    }
}