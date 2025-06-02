<?php

namespace App\traits;

use Illuminate\Support\Facades\Config;

trait CalculatesTax
{

    public function calculatePriceAfterTax(float $basePrice): float
    {
        $taxRate = Config::get('tax.rate', 0.15);
        return $basePrice * (1 + $taxRate);
    }

    public function getPriceAfterTaxAttribute(): float
    {
        return $this->calculatePriceAfterTax($this->price);
    }
}