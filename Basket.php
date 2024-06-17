<?php

class Basket {
    // Properties to hold product catalogue, delivery charge rules, special offers, and added products
    private $productCatalogue;
    private $deliveryChargeRules;
    private $specialOffers;
    private $products;

    public function __construct($productCatalogue, $deliveryChargeRules, $specialOffers) {
        $this->productCatalogue = $productCatalogue;
        $this->deliveryChargeRules = $deliveryChargeRules;
        $this->specialOffers = $specialOffers;
        $this->products = [];
    }

    // Method to add a product to the basket
    public function add($productCode) {
        // Check if the product exists in the catalogue
        if (!isset($this->productCatalogue[$productCode])) {
            throw new InvalidArgumentException("Product with code $productCode does not exist.");
        }
        $this->products[] = $productCode;
    }

    // Method to calculate the total cost of the basket
    public function total() {
        $subtotal = 0;

        // Calculate the subtotal by summing up the prices of all added products
        foreach ($this->products as $productCode) {
            $subtotal += $this->productCatalogue[$productCode]['price'];
        }

        // Apply special offers (e.g., Buy One Get One) to the subtotal
        foreach ($this->specialOffers as $offer) {
            if ($offer['type'] === 'BOGO' && in_array($offer['product'], $this->products)) {
                $count = array_count_values($this->products)[$offer['product']];
                $discountedCount = floor($count / 2);
                $discount = $discountedCount * ($this->productCatalogue[$offer['product']]['price'] / 2);
                $subtotal -= $discount;
            }
        }

        $deliveryCost = 0;
        $totalCost = $subtotal;

        // Determine the delivery cost based on the subtotal and delivery charge rules
        foreach ($this->deliveryChargeRules as $rule) {
            if ($subtotal < $rule['threshold']) {
                $deliveryCost = $rule['cost'];
                break;
            }
        }

        // Add the delivery cost to the total cost
        $totalCost += $deliveryCost;

        // Return the total cost formatted to 2 decimal places
        return number_format($totalCost, 2);
    }
}

