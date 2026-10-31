<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Location;
use App\Models\Product;

class ProductController extends Controller
{
    private function validateProduct(Request $request) {
        return $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'expiry_date' => 'required|date',
            'category_id' => 'nullable|integer|exists:categories,id', 
            'location_id' => 'nullable|integer|exists:locations,id',
        ]);
    }

    function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    function show(Product $product) {
        return view('products.show', compact('product'));
    }

    function create() {
        $categories = Category::all();
        $locations = Location::all();
        $product = new Product();
        return view('products.create', compact('categories', 'locations', 'product'));
    }

    function store(Request $request) {
        Product::create($this->validateProduct($request));
        return redirect()->route('products.index');
    }

    function edit(Product $product) {
        $categories = Category::all();
        $locations = Location::all();
        return view('products.edit', compact('product', 'locations', 'products'));
    }

    function update(Request $request, Product $product) {
        $product->update($this->validateProduct($request));
        return redirect()->route('products.show', $product);
    }

    function destroy(Product $product) {
        $product->delete();
        return redirect()->route('products.index');
    }
}
