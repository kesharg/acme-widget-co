<?php

use AcmeWidget\Basket;
use AcmeWidget\Product;
use AcmeWidget\StandardDelivery;
use AcmeWidget\RedWidgetOffer;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase {

    // Helper: Create products by code (price lookup)
    private function createProductsByCode(array $codes): array {

        $priceMap = json_decode(file_get_contents('data/products.json'), true);


        $products = [];
        foreach ($codes as $code) {
            $products[] = new Product($code, $priceMap[$code]);
        }
        return $products;
    }

    // Helper: Add products to basket by code
    private function createBasketWithProducts(array $productCodes): Basket {
        $basket = new Basket(new StandardDelivery(), new RedWidgetOffer());
        $products = $this->createProductsByCode($productCodes);
        foreach ($products as $product) {
            $basket->add($product);
        }
        return $basket;
    }

    // Tests
    public function testTotalWithoutOffer() {
        $basket = $this->createBasketWithProducts(["B01", "G01"]);
        $this->assertEquals(37.85, $basket->total());
    }

    public function testTotalWithOffer() {
        $basket = $this->createBasketWithProducts(["R01", "R01"]);
        $this->assertEquals(54.37, $basket->total());
    }

    public function testTotalWithDeliveryCost() {
        $basket = $this->createBasketWithProducts(["R01", "G01"]);
        $this->assertEquals(60.85, $basket->total());
    }

    public function testTotalWithOfferDeliveryCost() {
        $basket = $this->createBasketWithProducts(["B01", "B01", "R01", "R01", "R01"]);
        $this->assertEquals(98.27, $basket->total());
    }

    public function testBasketWithThreeRedWidgets() {
        $basket = $this->createBasketWithProducts(["R01", "R01", "R01"]);
        $this->assertEquals(85.32, $basket->total());
    }

    public function testBasketWithOneRedOneGreenOneBlueWidget() {
        $basket = $this->createBasketWithProducts(["B01", "G01", "R01"]);
        $this->assertEquals(68.8, $basket->total());
    }

    public function testBasketWithAllProductsAndOffer() {
        $basket = $this->createBasketWithProducts(["B01", "G01", "R01", "R01"]);
        $this->assertEquals(85.27, $basket->total());
    }
}
