<?php

namespace AcmeWidget;

/**
 * RedWidgetOffer applies a discount to red widgets.
 * 
 * The offer provides a "Buy one red widget, get the second half-price" deal.
 * This class implements the OfferStrategy interface to allow different types of offers.
 */
class RedWidgetOffer implements OfferStrategy
{
    /**
     * Apply the offer to a given list of products.
     * 
     * This method calculates the discount based on the "buy one, get one half price" offer for red widgets.
     * It assumes the product codes for red widgets are "R01".
     * 
     * @param Product[] $products
     * @return float The total discount applicable to the basket.
     * 
     */

    public function applyOffer(array $products): float
    {
        $totalDiscount = 0;
        $redWidgetCount = 0;
        $redWidgetPrices = [];

        // Loop through products to count and gather red widgets' prices
        foreach ($products as $product) {
            if ($product->getCode() === 'R01') {
                $redWidgetCount++;
                $redWidgetPrices[] = $product->getPrice();
            }
        }

        // If there are more than one red widget, apply the discount to the second one
        if ($redWidgetCount > 1) {
            // Apply discount to the second red widget (half price)
            $totalDiscount = $redWidgetPrices[1] / 2;
        }

        return $totalDiscount;
    }
}
