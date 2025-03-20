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
         $discount = 0;
         $redWidgetCount = 0;
 
         foreach ($products as $product) {
             if ($product->getCode() === 'R01') {
                 $redWidgetCount++;
                 // Apply 50% discount to the second, fourth, etc., red widget
                 if ($redWidgetCount % 2 === 0) {
                     $discount += $product->getPrice() / 2;
                 }
             }
         }
 
         return $discount;
     }
}
