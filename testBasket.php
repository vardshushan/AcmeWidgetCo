<?php
require_once 'Basket.php';


$productCatalogue = [
    'R01' => ['name' => 'Red Widget', 'price' => 32.95],
    'G01' => ['name' => 'Green Widget', 'price' => 24.95],
    'B01' => ['name' => 'Blue Widget', 'price' => 7.95]
];

$deliveryChargeRules = [
    ['threshold' => 90, 'cost' => 0],
    ['threshold' => 50, 'cost' => 2.95],
    ['threshold' => 0, 'cost' => 4.95]
];

$specialOffers = [
    ['type' => 'BOGO', 'product' => 'R01']
];


$basket = new Basket($productCatalogue, $deliveryChargeRules, $specialOffers);

try {
    $basket->add('B01');
    $basket->add('G01');
    echo "Total: " . $basket->total() . "\n"; // Expected: $37.85

    $basket->add('R01');
    $basket->add('R01');
    echo "Total: " . $basket->total() . "\n"; // Expected: $54.37

    $basket->add('R01');
    $basket->add('G01');
    echo "Total: " . $basket->total() . "\n"; // Expected: $60.85

    $basket->add('B01');
    $basket->add('B01');
    $basket->add('R01');
    $basket->add('R01');
    $basket->add('R01');
    echo "Total: " . $basket->total() . "\n"; // Expected: $98.27

} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

