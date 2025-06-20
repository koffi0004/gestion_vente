@extends('layouts.app')

@section('content')
<div class="container mt-4" id="receipt">
    <h2 class="text-center">🧾 Reçu de Vente</h2>
    <hr>
    <p><strong>Date :</strong> {{ $sale->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Client :</strong> {{ $sale->client->name ?? 'Inconnu' }}</p>
    <p><strong>Méthode de paiement :</strong> {{ $sale->payment_method }}</p>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price, 0) }} FCFA</td>
                    <td>{{ number_format($item->total_price, 0) }} FCFA</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-end"><strong>Total</strong></td>
                <td><strong>{{ number_format($sale->total_amount, 0) }} FCFA</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="text-center">
        <button onclick="window.print()" class="btn btn-primary">🖨 Imprimer le reçu</button>
        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Retour aux ventes</a>
    </div>
</div>
@endsection