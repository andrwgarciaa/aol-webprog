<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;

class ProductController extends Controller
{
    public function productsIndex(): View
    {
        $products = Product::join('users', 'products.seller_id', '=', 'users.id')
            ->where('products.quantity', '>', 0)
            ->select('products.*', 'users.name as seller_name')
            ->get();

        return view('catalog')->with('products', $products);
    }

    public function addProductIndex(): View
    {
        return view('add-product');
    }

    public function storeProduct(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'quantity' => 'required|numeric',

        ]);

        $product = new Product();
        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->description = $validatedData['description'] ?? '';
        $product->quantity = $validatedData['quantity'];
        $product->seller_id = $request->user()->id;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    public function productDetailIndex($id): View
    {
        $product = Product::join('users', 'products.seller_id', '=', 'users.id')
            ->where('products.id', $id)
            ->select('products.*', 'users.name as seller_name')
            ->firstOrFail();

        return view('product.product-detail')->with('product', $product);
    }
}
