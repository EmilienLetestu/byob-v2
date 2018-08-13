<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 13/08/2018
 * Time: 09:55
 */

namespace App\Action\Delete;

use App\Entity\Person;
use App\Responder\Delete\DeletePersonResponder;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DeletePersonAction
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * DeletePersonResponder constructor.
     * @param EntityManagerInterface $doctrine
     * @param SessionInterface $session
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        SessionInterface       $session
    )
    {
        $this->doctrine     = $doctrine;
        $this->session      = $session;
    }

    /**
     * @Route(
     *     "/supprimer/person/{id}",
     *     name = "deletePerson",
     *     requirements={ "id" = "\d+" }
     * )
     *
     * @param Request $request
     * @param DeletePersonResponder $responder
     * @return Response
     */
    public function __invoke(Request $request, DeletePersonResponder $responder): Response
    {
        $person = $this->doctrine
            ->getRepository(Person::class)
            ->findPersonWithId($request->get('id'))
        ;

        $this->doctrine->remove($person);
        $this->doctrine->flush();

        $this->session->getFlashBag()
            ->add('success', 'Contact supprimé avec succés')
        ;

        return $responder(
            $request->headers->get('referer')
        );

    }
}