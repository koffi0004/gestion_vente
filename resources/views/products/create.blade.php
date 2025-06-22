@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un produit</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="unit">Unité</label>
            <select name="unit" class="form-control" required>
                <option value="kg">Kilogramme</option>
                <option value="litre">Litre</option>
                <option value="piece">Pièce</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Prix de vente (FCFA)</label>
            <input type="number" name="sale_price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Prix d'achat (FCFA)</label>
            <input type="number" name="purchase_price" class="form-control" required>
        </div>


        <div class="mb-3">
            <label>Quantité en stock</label>
            <input type="number" name="stock_quantity" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection