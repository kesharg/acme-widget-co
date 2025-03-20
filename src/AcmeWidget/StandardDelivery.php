<?php

namespace AcmeWidget;

/**
 * StandardDelivery calculates delivery cost based on total basket value.
 * 
 * Implements the DeliveryStrategy interface to allow flexible delivery cost logic.
 */
class StandardDelivery implements DeliveryStrategy
{
    /**
     * Calculate the delivery cost based on the total amount.
     * 
     * Delivery rules:
     * - Orders under $50: $4.95
     * - Orders between $50 and $90: $2.95
     * - Orders $90 and above: Free delivery
     * 
     * @param float $total The total value of the basket before delivery.
     * @return float The delivery cost.
     */
    public function calculate(float $total): float
    {
        if ($total < 50) {
            return 4.95;
        } elseif ($total < 90) {
            return 2.95;
        }
        return 0.00;
    }
}
