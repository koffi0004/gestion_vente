<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $query = Product::query();

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $products = $query->get();
    $lowStockProducts = Product::where('stock_quantity', '<', 20)->get();

    return view('products.index', compact('products', 'lowStockProducts'));
}

    public function create()
    {
        return view('products.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'sale_price' => 'required|numeric',
        'stock_quantity' => 'required|integer',
    ]);

    Product::create($request->all());

    return redirect()->route('products.index')->with('success', 'Produit ajouté avec succès.');
}

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'sale_price' => 'required|numeric',
        'stock_quantity' => 'required|integer',
    ]);

    $product->update($request->all());

    return redirect()->route('products.index')->with('success', 'Produit mis à jour avec succès.');
}

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produit supprimé.');
    }
}