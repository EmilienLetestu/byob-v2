<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 06/08/2018
 * Time: 23:13
 */

namespace App\Services;


use App\Entity\InOrderProduct;
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
        $this->doctrine        = $doctrine;
        $this->inStockProduct  = new InStockProduct();
        $this->stockValidation = new StockValidation();
    }

    /**
     * Based on route name decide which process to launch (validation or denial)
     *
     * @param string $action
     * @param int $pendingId
     * @param User $user
     */
    public function ValidateOrReject(string $action, int $pendingId, User $user)
    {
        $action === 'valider' ?
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
            $this->createStock($pendingValidation)
            :
            $this->addToStock($inStock, $pendingValidation->getQuantity(), $pendingValidation->getWarehouse()->getId())
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
     * Triggered if the product never been stocked in the warehouse
     *
     * @param PendingValidationStock $pending
     */
    private function createStock(PendingValidationStock $pending)
    {
        $this->inStockProduct->setWarehouse($pending->getWarehouse());
        $this->inStockProduct->setProduct($pending->getProduct());
        $this->inStockProduct->setLevel($pending->getQuantity());
        $this->inStockProduct->setAlertLevel(15);

        $this->doctrine->persist($this->inStockProduct);
    }

    /**
     * Triggered if a stock already exist
     *
     * @param InStockProduct $inStockProduct
     * @param int $quantity
     */
    private function addToStock(InStockProduct $inStockProduct, int $quantity, $warehouseId)
    {
       $addToStock = $this->provisionBackOrderFirst($warehouseId, $quantity, $inStockProduct->getProduct()->getId());
       $level =  $inStockProduct->getLevel();
       $inStockProduct->setLevel($level + $addToStock);

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

    /**
     * @param $warehouseId
     * @param $quantity
     * @param $productId
     * @return int
     */
    private function provisionBackOrderFirst($warehouseId, $quantity, $productId): int
    {
        $inOrders =  $this->doctrine->getRepository(InOrderProduct::class)
            ->findAllWithBackOrderAndWarehouse($warehouseId, $quantity, $productId);



        if(count($inOrders) > 0){

            while ($quantity > 0 and count($inOrders)){

                $inOrder = array_shift($inOrders);


                if($quantity > $inOrder->getQuantity())
                {
                    $backOrder = $inOrder->getBackOrder();
                    $backOrder->setRegularize(true);
                    $backOrder->setregularizedOn('Y-m-d');
                    $quantity -= $inOrder->getQuantity();
                }

            }

            return $quantity;
        }


        return $quantity;


    }

}