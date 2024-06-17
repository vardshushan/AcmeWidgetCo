# Basket Class

## Overview

The `Basket` class manages a shopping basket with products, applies special offers, and calculates the total cost including delivery charges based on predefined rules.

## Usage

To use the `Basket` class:

1. **Instantiate the Basket:**
   ```php
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
   
2. **Adding Products**
```php
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
```
3. **Special Offers and Delivery Charges:**
   1. **Special Offers:** The Basket class supports special offers such as BOGO (Buy One Get One Free). When a qualifying product is added to the basket, every second instance of that product is discounted according to the offer rules.
   2. **Delivery Charges:** Delivery costs are calculated based on predefined rules ($deliveryChargeRules) that specify thresholds and associated costs. The appropriate delivery cost is added to the total based on the subtotal of the basket.

4. **Assumptions**
   1. The product catalogue ($productCatalogue) and delivery charge rules ($deliveryChargeRules) are correctly formatted and provided.
   2. Special offers ($specialOffers) are correctly defined with valid types ('BOGO', etc.) and associated product codes.
   3. Products added to the basket are identified by their unique product codes as defined in the catalogue ('R01', 'G01', 'B01', etc.).

5. **Notes**
   1. Verify that the product codes used ('R01', 'G01', 'B01', etc.) match those defined in the $productCatalogue.
   2. Ensure the expected output matches the provided examples ($37.85, $54.37, $60.85, $98.27, etc.) to confirm correct functionality.

