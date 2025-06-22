@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des produits</h1>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Ajouter un produit</a>
    <a href="{{ route('products.export.stock.pdf') }}" class="btn btn-outline-danger mb-3">
    🧾 État du stock (PDF)
</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($lowStockProducts->count())
    <div class="alert alert-warning">
        <strong>Attention :</strong> Certains produits ont un stock faible !
        <ul>
            @foreach($lowStockProducts as $product)
                <li>{{ $product->name }} : {{ $product->stock_quantity }} en stock</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="GET" action="{{ route('products.index') }}" class="mb-3">
    <input type="text" name="search" placeholder="Rechercher un produit..." value="{{ request('search') }}" class="form-control" />
</form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix (FCFA)</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description ?? '-' }}</td>
                <td>{{ number_format($product->sale_price, 0) }}</td>
                <td>{{ $product->stock_quantity }}</td>
                <td>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Modifier</a>

                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Confirmer la suppression ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection