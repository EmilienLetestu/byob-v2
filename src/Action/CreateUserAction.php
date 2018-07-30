<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 19:02
 */

namespace App\Action;

use App\Form\Type\CreateUserType;
use App\Responder\CreateUserResponder;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class CreateUserAction
 * @package App\Action
 */
class CreateUserAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;


    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * @Route("/utilisateur/ajouter", name="createUser")
     *
     * @param Request $request
     * @param CreateUserResponder $responder
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, CreateUserResponder $responder)
    {
        $form = $this->formFactory
            ->create(CreateUserType::class)
            ->handleRequest($request)
        ;

        return $responder(
            $form->createView()
        );
    }

}