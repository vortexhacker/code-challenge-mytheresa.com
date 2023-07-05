<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

/**
 * Author: Ruphin Lobanga
 * Date: July 04, 2023
 * Email: ruphiny2j@gmail.com
 */

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Read the products list from the JSON file
        $products = json_decode(file_get_contents(storage_path('app/products.json')), true)['products'];

        // Filter products by category
        if ($request->has('category')) {
            $category = $request->input('category');
            $products = array_filter($products, function ($product) use ($category) {
                return $product['category'] === $category;
            });
        }

        // Filter products by priceLessThan
        if ($request->has('priceLessThan')) {
            $priceLessThan = intval($request->input('priceLessThan'));
            $products = array_filter($products, function ($product) use ($priceLessThan) {
                return $product['price'] <= $priceLessThan;
            });
        }

        // Apply discounts to products
        foreach ($products as &$product) {
            if ($product['sku'] === '000003') {
                $product['price'] = round($product['price'] * 0.85);
            } elseif ($product['category'] === 'boots') {
                $product['price'] = round($product['price'] * 0.7);
            }
        }

        // Sort products by price (ascending)
        usort($products, function ($a, $b) {
            return $a['price'] - $b['price'];
        });

        // Limit the number of products to 5
        $products = array_slice($products, 0, 5);
        return response()->json(['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
