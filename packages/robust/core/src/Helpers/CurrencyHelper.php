<?php

namespace Robust\Core\Helpers;

use Robust\Core\Helpers\Currencies\BaseCurrency;


/**
 * Class CurrencyHelper
 * @package Robust\Core\Helpers
 */
class CurrencyHelper extends BaseCurrency
{
    /**
     * CurrencyHelper constructor.
     */
    public function __construct()
    {
        $this->currency = with(new \Robust\Core\Helpers\Currencies\NRS);
    }

    /**
     * @param $price
     * @return int
     */
    public function format($price)
    {
        return $this->currency->prefix($price, 2);
    }
}