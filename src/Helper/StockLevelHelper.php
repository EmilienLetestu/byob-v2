<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 07/08/2018
 * Time: 10:45
 */

namespace App\Helper;

use App\Entity\Product;

class StockLevelHelper
{
    /**
     * addition all stocks for a given product no matter where the stocks are
     *
     * @param Product $product
     * @return int
     */
    public function productGlobalStock(Product $product): int
    {
        $globalStock = 0;

        foreach($product->getInStockProducts() as $inStockProduct)
        {
            $globalStock += $inStockProduct->getLevel();
        }

        return $globalStock;
    }
}