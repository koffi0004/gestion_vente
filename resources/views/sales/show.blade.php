@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails de la vente #{{ $sale->id }}</h1>

    <p><strong>Date :</strong> {{ $sale->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Client :</strong> {{ $sale->client->name ?? 'Non défini' }}</p>
    <p><strong>Méthode de paiement :</strong> {{ $sale->payment_method }}</p>
    <p><strong>Total :</strong> {{ number_format($sale->total_amount, 2) }} FCFA</p>

    <h4 class="mt-4">Produits :</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($sale->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->unit_price, 2) }} FCFA</td>
                <td>{{ number_format($item->total_price, 2) }} FCFA</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('sales.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection