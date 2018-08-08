<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 12:43
 */

namespace App\Handler;


use App\Entity\InOrderProduct;
use App\Handler\Interfaces\EntityFormHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class InOrderProductHandler implements EntityFormHandlerInterface
{
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var InOrderProduct
     */
    private $inOrder;

    /**
     * InOrderProductHandler constructor.
     * @param SessionInterface $session
     */
    public function __construct(
        SessionInterface $session
    )
    {
        $this->session = $session;
        $this->inOrder = new InOrderProduct();
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid())
        {
            $this->inOrder->setProduct(
                $form->get('product')->getData()->getProduct()
            );

            $this->inOrder->setQuantity(
                $form->get('quantity')->getData()
            );

           $order = $this->session->get('order');
           $order->addInOrderProduct($this->inOrder);

           $this->session->set('order',$order);

           return true;
        }

        return false;
    }
}
