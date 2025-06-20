<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Client;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('client')->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $clients = Client::all();
        $products = Product::all();
        return view('sales.create', compact('clients', 'products'));
    }

   public function store(Request $request)
{
    $sale = null;

    DB::transaction(function () use ($request, &$sale) {
        $sale = Sale::create([
            'user_id' => auth()->id(),
            'client_id' => $request->client_id,
            'total_amount' => $request->total_amount,
            'payment_method' => $request->payment_method,
            'note' => $request->note,
        ]);

        foreach ($request->products as $index => $productData) {
            if ($productData['quantity'] > 0) {
                $product = Product::find($productData['product_id']);
                $subtotal = $productData['quantity'] * $productData['unit_price'];

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $productData['product_id'],
                    'quantity' => $productData['quantity'],
                    'unit_price' => $productData['unit_price'],
                    'total_price' => $subtotal,
                ]);

                $product->decrement('stock_quantity', $productData['quantity']);
            }
        }
    });

    // ✅ Rediriger vers le reçu après création
    return redirect()->route('sales.receipt', $sale->id);
}

public function receipt(Sale $sale)
{
    $sale->load('client', 'items.product');
    return view('sales.receipt', compact('sale'));
}
    public function show(Sale $sale)
    {
        $sale->load('client', 'items.product');
        return view('sales.show', compact('sale'));
    }
}