<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\AssertableJson;

/**
 * Author: Ruphin Lobanga
 * Date: July 04, 2023
 * Email: ruphiny2j@gmail.com
 */

class ProductTest extends TestCase
{
    /**
     * Test case for returning discounted products filtered by category.
     *
     * @return void
     */
    public function testReturnsDiscountedProductsFilteredByCategory()
    {
        // Make a GET request to the /api/products endpoint with the category filter
        $response = $this->get('/api/products?category=boots');

        // Assert that the response is successful (HTTP status code 200)
        $response->assertOk();

        // Decode the JSON response
        $jsonResponse = $response->decodeResponseJson();

        // Assert that the response contains at most 2 products
        $this->assertCount(2, $jsonResponse['products']);

        // Assert that all products in the response have the 'boots' category
        foreach ($jsonResponse['products'] as $product) {
            $this->assertEquals('boots', $product['category']);
        }

        // Assert that the discounted products have the discount applied correctly
        $this->assertDiscountedProduct($jsonResponse['products'][0], 49700);
        $this->assertDiscountedProduct($jsonResponse['products'][1], 62300);
    }

    /**
     * Test case for returning discounted products filtered by price.
     *
     * @return void
     */
    public function testReturnsDiscountedProductsFilteredByPrice()
    {
        // Make a GET request to the /api/products endpoint with the price filter
        $response = $this->get('/api/products?price=1000-2000');

        // Assert that the response is successful (HTTP status code 200)
        $response->assertOk();

        // Decode the JSON response
        $jsonResponse = $response->decodeResponseJson();

        // Assert that the response contains at most 2 products
        $this->assertCount(3, $jsonResponse['products']);

        // Assert that all products in the response have prices within the specified range
        foreach ($jsonResponse['products'] as $product) {
            $this->assertGreaterThanOrEqual(1000, $product['price']);
            $this->assertLessThanOrEqual(67575, $product['price']);
        }

        // Assert that the discounted products have the discount applied correctly
        $this->assertDiscountedProduct($jsonResponse['products'][0], 49700);
        $this->assertDiscountedProduct($jsonResponse['products'][1], 62300);
    }

    /**
     * Helper method to assert the discounted product.
     *
     * @param  object  $product
     * @param  int  $discountedPrice
     * @return void
     */
    private function assertDiscountedProduct($product, $originalPrice)
    {
        $discountPercentage = round((1 - ($product['price'] / $originalPrice)) * 100);

        $this->assertEquals($originalPrice, $product['price']);
        $this->assertArrayNotHasKey('discount_percentage', $product);
    }
}
