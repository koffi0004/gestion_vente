@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Détails de la vente #{{ $sale->id }}</h1>

    <p><strong>Date :</strong> {{ $sale->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Client :</strong> {{ $sale->client->name ?? 'Non défini' }}</p>
    <p><strong>Téléphone :</strong> {{ $sale->client->phone ?? 'Non défini' }}</p>
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
<a href="{{ route('sales.receipt', $sale->id) }}" class="btn btn-primary" target="_blank">
    Imprimer le reçu
</a>
    <a href="{{ route('sales.index') }}" class="btn btn-secondary">Retour</a>
</div>
@if(!$sale->canceled_at)
    <form action="{{ route('sales.cancel', $sale) }}" method="POST" onsubmit="return confirm('Annuler cette vente ?');">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="reason" class="form-label">Justification :</label>
            <textarea name="reason" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-danger">Annuler la vente</button>
    </form>
@else
    <div class="alert alert-warning mt-3">
        <strong>Vente annulée le {{ $sale->canceled_at->format('d/m/Y à H:i') }}</strong><br>
        Raison : {{ $sale->cancellation_reason }}
    </div>
@endif
@endsection