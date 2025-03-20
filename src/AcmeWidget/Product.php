<?php

namespace AcmeWidget;
/**
 * The Product class represents a product with a code and a price.
 * 
 * It provides methods to retrieve the product's code and price.
 */
class Product {
    private string $code;
    private float $price;

    public function __construct(string $code, float $price) {
        $this->code = $code;
        $this->price = $price;
    }

    public function getCode(): string {
        return $this->code;
    }

    public function getPrice(): float {
        return $this->price;
    }
}
