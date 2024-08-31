<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(): \Illuminate\View\View
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('products.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validate = $request->validate([
            'product' => 'required|min:2|max:50|string',
            'supplier' => 'required|min:2|max:50|string',
            'price' => 'required|min:0|numeric',
            'description' => 'required|min:2|max:255|string',
        ]);
        $supplier = Supplier::firstOrCreate([
            'name' => $validate['supplier']
        ]);
        Product::create([
            'name' => $validate['product'],
            'supplier_id' => $supplier->id,
            'price' => $validate['price'],
            'description' => $validate['description'],
        ]);

        return redirect('/products');
    }

    public function show(Product $product): \Illuminate\View\View
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product): \Illuminate\View\View
    {
        return view('products.edit', compact('product'));
    }

    public function update(Product $product, Request $request): \Illuminate\Http\RedirectResponse
    {
        $validate = $request->validate([
            'product' => 'required|min:2|max:50|string',
            'supplier' => 'required|min:2|max:50|string',
            'price' => 'required|min:0|numeric',
            'description' => 'required|min:2|max:255|string',
        ]);

        $supplier = Supplier::firstOrCreate(['name' => $validate['supplier']]);

        $product->update([
            'name' => $validate['product'],
            'supplier_id' => $supplier->id,
            'price' => $validate['price'],
            'description' => $validate['description'],
        ]);

        return redirect("/products/$product->id");
    }

    public function destroy(Product $product): \Illuminate\Http\RedirectResponse
    {
        $product->delete();
        return redirect('/products');
    }
}
