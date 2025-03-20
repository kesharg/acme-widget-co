<?php

namespace AcmeWidget;

/**
 * The Basket class manages the products, offers, and delivery costs for a shopping basket.
 * 
 * This class is responsible for adding products to the basket, calculating the total cost,
 * applying offers, and determining the appropriate delivery cost.
 */
class Basket
{
    /** @var Product[] */
    private $products = [];
    private DeliveryStrategy $deliveryStrategy;
    private OfferStrategy $offerStrategy;

    public function __construct(DeliveryStrategy $deliveryStrategy, OfferStrategy $offerStrategy)
    {
        $this->deliveryStrategy = $deliveryStrategy;
        $this->offerStrategy = $offerStrategy;
    }
    /**
     * Add a product to the basket.
     * 
     * @param Product $product
     */
    public function add(Product $product): void
    {
        $this->products[] = $product;
    }
    /**
     * Calculate the total cost of the basket, including products, offer discounts, and delivery cost.
     * 
     * @return float
     */
    public function total(): float
    {
        // Calculate the total price of products
        $total = array_reduce($this->products, fn($sum, $product) => $sum + $product->getPrice(), 0);
    
        // If there are no products, return 0
        if ($total === 0) {
            return 0;
        }
    
        // Apply offer discount
        $offerDiscount = $this->offerStrategy->applyOffer($this->products);
    
        // Calculate delivery cost based on the discounted total
        $deliveryCost = $this->deliveryStrategy->calculate($total - $offerDiscount);
    
        // Calculate the final total and round to 2 decimal places
        $finalTotal = ($total - $offerDiscount) + $deliveryCost;
        return floor($finalTotal * 100) / 100;
    }
    
}
