@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nouvelle vente</h1>

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        <!-- Choix du client -->
        <div class="mb-3">
            <label for="client_id">Client :</label>
            <select name="client_id" class="form-control" required>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Table des produits -->
       <table class="table table-bordered" id="products_table">
    <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix unitaire</th>
            <th>Sous-total</th>
            <th></th>
        </tr>
    </thead>
   <tbody id="product_rows">
    <tr>
        <td>
            <select name="products[0][product_id]" class="form-control product-select" required onchange="updateRow(0)">
                <option value="">-- Choisir --</option>
               <!-- Dans le <select> produit, on ajoute data-stock -->
@foreach($products as $product)
    <option value="{{ $product->id }}" 
        data-price="{{ $product->sale_price }}" 
        data-stock="{{ $product->stock_quantity }}">
        {{ $product->name }} ({{ number_format($product->sale_price, 0) }} FCFA | Stock: {{ $product->stock_quantity }})
    </option>
@endforeach
            </select>
        </td>
        <td>
            <input type="number" name="products[0][quantity]" class="form-control quantity" value="1" min="1" onchange="updateRow(0)">
        </td>
        <td>
            <input type="text" name="products[0][unit_price]" class="form-control unit_price"eadonly>
        </td>
        <td>
            <input type="text" name="products[0][total_price]" class="form-control total_price" readonly>
        </td>
        <td>
            <button type="button" class="btn btn-danger" onclick="removeRow(this)">X</button>
        </td>
    </tr>
</tbody>
</table>

        <button type="button" class="btn btn-secondary" onclick="addRow()">Ajouter un produit</button>

        <!-- Total général -->
        <div class="mt-3">
            <h4>Total : <span id="grand_total">0</span> FCFA</h4>
            <input type="hidden" name="total_amount" id="total_amount">
        </div>

        <!-- Paiement -->
        <div class="mb-3 mt-3">
            <label for="payment_method">Méthode de paiement</label>
            <select name="payment_method" class="form-control" required>
                <option value="cash">Cash</option>
                <option value="mobile">Mobile Money</option>
                <option value="credit">Crédit</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Valider la vente</button>
    </form>
</div>

<script>
    let rowIndex = 1;

    function updateRow(index) {
        const row = document.querySelectorAll('#product_rows tr')[index];
        const select = row.querySelector('.product-select');
        const price = parseFloat(select.options[select.selectedIndex]?.dataset.price || 0);
        const quantity = parseInt(row.querySelector('.quantity').value) || 0;

        const unitInput = row.querySelector('.unit_price');
        const totalInput = row.querySelector('.total_price');

        unitInput.value = price.toFixed(2);
        totalInput.value = (price * quantity).toFixed(2);

        updateTotal();
    }

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.total_price').forEach(input => {
            total += parseFloat(input.value) || 0;
        });

        document.getElementById('grand_total').innerText = total.toFixed(2);
        document.getElementById('total_amount').value = total.toFixed(2);
    }

    function addRow() {
        const rows = document.querySelectorAll('#product_rows tr');
        const lastRow = rows[rows.length - 1];
        const newRow = lastRow.cloneNode(true);

        // Mettre à jour les noms des champs
        newRow.querySelectorAll('select, input').forEach(input => {
            input.name = input.name.replace(/\d+/, rowIndex);
            if (input.classList.contains('quantity')) input.value = 1;
            if (input.classList.contains('unit_price') || input.classList.contains('total_price')) input.value = '';
            if (input.tagName === 'SELECT') input.selectedIndex = 0;
        });

        document.getElementById('product_rows').appendChild(newRow);
        rowIndex++;
    }

    function removeRow(button) {
        const rows = document.querySelectorAll('#product_rows tr');
        if (rows.length > 1) {
            button.closest('tr').remove();
            updateTotal();
        }
    }
</script>
@endsection