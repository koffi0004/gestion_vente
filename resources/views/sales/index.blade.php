@extends('layouts.app')

@section('content')
    <h1>Historique des ventes</h1>
    <a href="{{ route('sales.create') }}" class="btn btn-success mb-3">Nouvelle vente</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Client</th>
                <th>Total</th>
                <th>Paiement</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
       @foreach($sales as $sale)
    <tr @if($sale->canceled_at) class="table-danger" @endif>
        <td>{{ $sale->created_at->format('d/m/Y') }}</td>
        <td>{{ $sale->client->name ?? 'Client inconnu' }}</td>
        <td>{{ $sale->total_amount }} FCFA</td>
        <td>{{ $sale->payment_method }}</td>
        <td>
            @if($sale->canceled_at)
                <span class="badge bg-danger">Annulée</span>
            @endif
            <a href="{{ route('sales.show', $sale) }}" class="btn btn-sm btn-info">Voir</a>
        </td>
    </tr>
@endforeach
        </tbody>
    </table>
@endsection