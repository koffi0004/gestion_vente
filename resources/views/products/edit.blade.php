@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier produit</h1>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name">Nom du produit</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="sale_price">Prix de vente (FCFA)</label>
            <input type="number" name="sale_price" class="form-control" value="{{ $product->sale_price }}" required>
        </div>

        <div class="mb-3">
            <label for="stock_quantity">Quantité en stock</label>
            <input type="number" name="stock_quantity" class="form-control" value="{{ $product->stock_quantity }}" required>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection