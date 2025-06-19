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
        DB::transaction(function () use ($request) {
            $sale = Sale::create([
                'user_id' => auth()->id(),
                'client_id' => $request->client_id,
                'total_amount' => $request->total_amount,
                'payment_method' => $request->payment_method,
                'note' => $request->note,
            ]);

            foreach ($request->products as $product_id => $quantity) {
                if ($quantity > 0) {
                    $product = Product::find($product_id);
                    $subtotal = $product->price * $quantity;

                    SaleItem::create([
                        'sale_id' => $sale->id,
                        'product_id' => $product_id,
                        'quantity' => $quantity,
                        'unit_price' => $product->price,
                        'subtotal' => $subtotal,
                    ]);

                    $product->decrement('stock_quantity', $quantity);
                }
            }
        });

        return redirect()->route('sales.index')->with('success', 'Vente enregistrée.');
    }

    public function show(Sale $sale)
    {
        $sale->load('client', 'items.product');
        return view('sales.show', compact('sale'));
    }
}