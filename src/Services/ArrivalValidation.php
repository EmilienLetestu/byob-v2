<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 06/08/2018
 * Time: 23:13
 */

namespace App\Services;


use App\Entity\InStockProduct;
use App\Entity\PendingValidationStock;
use App\Entity\StockValidation;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

/**
 * where the whole product arrival request process will be handled
 *
 * Class ArrivalValidation
 * @package App\Services
 */
class ArrivalValidation
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * @var InStockProduct
     */
    private $inStockProduct;

    /**
     * @var StockValidation
     */
    private $stockValidation;

    /**
     * ArrivalValidation constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(
        EntityManagerInterface $doctrine

    )
    {
        $this->doctrine = $doctrine;
        $this->inStockProduct = new InStockProduct();
        $this->stockValidation = new StockValidation();
    }

    /**
     * Based on route name decide which process to launch (validation or denial)
     *
     * @param string $route
     * @param int $pendingId
     * @param User $user
     */
    public function ValidateOrReject(string $route, int $pendingId, User $user)
    {
        $route === 'validateArrival' ?
            $this->validateArrival($pendingId, $user) :
            $this->rejectArrival($pendingId, $user)
        ;

    }

    /**
     * Handle arrival validation
     *
     * @param int $pendingId
     * @param User $user
     */
    private function validateArrival(int $pendingId, User $user)
    {

        $pendingValidation = $this->doctrine
            ->getRepository(PendingValidationStock::class)
            ->findPendingWithId($pendingId)
        ;

        $inStock = $this->doctrine
            ->getRepository(InStockProduct::class)
            ->findProductStockInWarehouse(
                $pendingValidation->getProduct()->getId(),
                $pendingValidation->getWarehouse()->getId()
            )
        ;


        $inStock === null ?
            $this->createStock(
                $pendingValidation->getProduct(),
                $pendingValidation->getWarehouse(),
                $pendingValidation->getQuantity()
            ):
            $this->addToStock($inStock, $pendingValidation->getQuantity())
        ;

        $this->updatePendingValidation($pendingValidation, true);
        $this->createStockValidation($user,$pendingValidation);

        $this->doctrine->flush();

    }

    /**
     * Handle denial process
     *
     * @param int $pendingId
     * @param User $user
     */
    private function rejectArrival(int $pendingId, User $user)
    {
        $pendingValidation = $this->doctrine
            ->getRepository(PendingValidationStock::class)
            ->findPendingWithId($pendingId)
        ;

        $this->updatePendingValidation($pendingValidation, false);
        $this->createStockValidation($user,$pendingValidation);

        $this->doctrine->flush();
    }

    /**
     * Triggered if the product never has been stocked in the warehouse
     *
     * @param $product
     * @param $warehouse
     * @param $quantity
     */
    private function createStock($product,$warehouse,$quantity)
    {
        $this->inStockProduct->setWarehouse($warehouse);
        $this->inStockProduct->setProduct($product);
        $this->inStockProduct->setLevel($quantity);
        $this->inStockProduct->setAlertLevel(15);

        $this->doctrine->persist($this->inStockProduct);
    }

    /**
     * Triggered if a stock already exist
     *
     * @param InStockProduct $inStockProduct
     * @param int $quantity
     */
    private function addToStock(InStockProduct $inStockProduct, int $quantity)
    {
       $level =  $inStockProduct->getLevel();
       $inStockProduct->setLevel($level + $quantity);

    }

    /**
     * @param PendingValidationStock $pending
     * @param bool $validate
     */
    private function updatePendingValidation(PendingValidationStock $pending, bool $validate)
    {

        $pending->setProcessed(true);
        $pending->setValidated($validate);
        $pending->setProcessedOn(new \DateTime(date('Y-m-d')));
    }

    /**
     * @param User $user
     * @param PendingValidationStock $pending
     */
    private function createStockValidation(User $user, PendingValidationStock $pending)
    {
        $this->stockValidation->setProcessedBy($user);
        $this->stockValidation->setPendingValidation($pending);
        $this->stockValidation->setProcessedOn('Y-m-d');

        $this->doctrine->persist($this->stockValidation);
    }

}