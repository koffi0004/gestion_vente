<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Client;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{

public function cancel(Request $request, Sale $sale)
{
    if ($sale->canceled_at) {
        return redirect()->back()->with('error', 'Vente déjà annulée.');
    }

    $request->validate([
        'reason' => 'required|string|max:1000',
    ]);

    DB::transaction(function () use ($sale, $request) {
        // Restaurer les quantités de stock
        foreach ($sale->items as $item) {
            $item->product->increment('stock_quantity', $item->quantity);
        }

        // Annuler la vente
        $sale->update([
            'canceled_at' => now(),
            'cancellation_reason' => $request->reason,
        ]);
    });

    return redirect()->route('sales.show', $sale)->with('success', 'Vente annulée avec succès.');
}


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
    // 💡 Étape 1 : validation basique
    $request->validate([
        'client_id' => 'required|exists:clients,id',
        'payment_method' => 'required|string',
        'products' => 'required|array|min:1',
        'products.*.product_id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|integer|min:1',
        'products.*.unit_price' => 'required|numeric|min:0',
    ]);

    // 💡 Étape 2 : vérification du stock
    foreach ($request->products as $item) {
        $product = Product::find($item['product_id']);

        if ($item['quantity'] > $product->stock_quantity) {
            return back()->withErrors([
                'stock' => "Stock insuffisant pour « {$product->name} » (disponible : {$product->stock_quantity}, demandé : {$item['quantity']})."
            ])->withInput();
        }
    }

    // 💡 Étape 3 : transaction
    $sale = null;
    DB::transaction(function () use ($request, &$sale) {
        $sale = Sale::create([
            'user_id' => auth()->id(),
            'client_id' => $request->client_id,
            'total_amount' => $request->total_amount,
            'payment_method' => $request->payment_method,
            'note' => $request->note,
        ]);

        foreach ($request->products as $productData) {
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

   

public function exportPdf()
{
    $sales = Sale::with('client')->latest()->get();
    $pdf = Pdf::loadView('exports.sales_pdf', compact('sales'));
    return $pdf->download('liste_ventes.pdf');
}

}