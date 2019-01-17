<?php
namespace Robust\Core\Helpers;

use Carbon\Carbon;
use Robust\Cart\Models\Product;
use Robust\Discounts\Models\CatalogDiscount;


/**
 * Class DiscountHelper
 * @package Robust\Core\Helpers
 */
class DiscountHelper
{
    private $discountType = [
        'product_id' => Product::class
    ];
    /**
     * DiscountHelper constructor.
     */
    public function __construct()
    {
        $this->discount = new CatalogDiscount;
    }

    /**
     * @param $product
     * @return int
     */
    public function getPrice($product)
    {
        $discounts = $this->discount->where('start_date','>=', Carbon::now())->get();
        foreach($discounts as $discount){
            //$product = Product::where();
        }

        return $this->currency->prefix($product->price, 2);
    }
}