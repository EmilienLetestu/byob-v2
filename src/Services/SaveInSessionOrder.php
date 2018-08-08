<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 08/08/2018
 * Time: 16:06
 */

namespace App\Services;


use App\Entity\InStockProduct;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class SaveInSessionOrder
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
     * SaveInSessionOrder constructor.
     * @param EntityManagerInterface $doctrine
     * @param SessionInterface $session
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        SessionInterface       $session

    )
    {
        $this->doctrine = $doctrine;
        $this->session  = $session;
    }

    public function saveOrderFromSession(): void
    {
        $order = $this->session->get('order');

        $customer = $this->doctrine->merge($order->getOrderedFor());
        $user     = $this->doctrine->merge($order->getOrderedBy());

        $order->setOrderedFor($customer);
        $order->setOrderedBy($user);

        $this->doctrine->persist($order);
        $this->doctrine->flush();


        $inOrderProducts = $order->getInOrderProducts();

        foreach ($inOrderProducts as $inOrderProduct)
        {
            $product = $this->doctrine->merge($inOrderProduct->getProduct());
            $inOrderProduct->setProduct($product);
            $inOrderProduct->setOrder($order);

            $this->doctrine->persist($inOrderProduct);

            $this->updateStock(
                $inOrderProduct->getProduct()->getId(),
                $inOrderProduct->getQuantity()
            );
        }

        $this->doctrine->flush();

        $this->session->getFlashBag()
            ->add('success', 'Commande signaler pour validation avec succès')
        ;
    }

    /**
     * @param int $productId
     * @param int $quantity
     * @return mixed
     */
    private function updateStock(int $productId, int $quantity)
    {
        $inStockProduct = $this->doctrine
            ->getRepository(InStockProduct::class)
            ->findWithProductAndAtLeast($productId, $quantity)
        ;

        $inStockProduct->setLevel(
            $inStockProduct->getLevel() - $quantity
        );

        return $inStockProduct;
    }
}
