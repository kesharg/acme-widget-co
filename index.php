<?php

// Autoload dependencies using Composer
require_once 'vendor/autoload.php';

use AcmeWidget\Product;
use AcmeWidget\StandardDelivery;
use AcmeWidget\RedWidgetOffer;
use AcmeWidget\Basket;

$priceMap = json_decode(file_get_contents('data/products.json'), true);

// Helper: Create product instances dynamically using price map
function createProduct($productCode)
{
    global $priceMap;
    if (isset($priceMap[$productCode])) {
        return new Product($productCode, $priceMap[$productCode]);
    }
    throw new Exception("Product code not found in price map: $productCode");
}

// Create strategy instances for Delivery and Offers
$deliveryStrategy = new StandardDelivery(); // Use the concrete class
$offerStrategy = new RedWidgetOffer();

// Create a new Basket with Delivery and Offer strategies
$basket = new Basket($deliveryStrategy, $offerStrategy);

$productCombinations = [
    ["B01", "G01"],
    ["R01", "R01"],
    ["R01", "G01"],
    ["B01", "B01", "R01", "R01", "R01"],
    ["R01", "R01", "R01", "R01", "B01", "R01", "G01", "R01"]
];

// HTML for displaying basket totals in a table
echo "<html><body><h2>Basket Summary</h2><table border='1'><tr><th>Products</th><th>Total</th></tr>";

foreach ($productCombinations as $products) {
    $basket = new Basket($deliveryStrategy, $offerStrategy);

    foreach ($products as $productCode) {
        $basket->add(createProduct($productCode));
    }

    $productsList = implode(", ", $products);
    echo "<tr><td>$productsList</td><td>$" . number_format($basket->total(), 2) . "</td></tr>";
}

echo "</table></body></html>";
