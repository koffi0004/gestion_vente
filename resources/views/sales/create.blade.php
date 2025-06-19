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
                        <select name="products[0][product_id]" class="form-control product-select" required onchange="updatePrice(0)">
                            <option value="">-- Choisir --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->sale_price }}">
                                    {{ $product->name }} ({{ $product->sale_price }} FCFA)
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="products[0][quantity]" class="form-control quantity" min="1" value="1" onchange="updateSubtotal(0)"></td>
                    <td><input type="number" name="products[0][price]" class="form-control price" readonly></td>
                    <td><input type="number" name="products[0][subtotal]" class="form-control subtotal" readonly></td>
                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">X</button></td>
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

    function addRow() {
        const newRow = document.querySelector('#product_rows tr').cloneNode(true);
        const html = newRow.innerHTML.replaceAll(/\[0\]/g, [${rowIndex}]);
        newRow.innerHTML = html;
        document.getElementById('product_rows').appendChild(newRow);
        resetRow(rowIndex);
        rowIndex++;
        updateTotal();
    }

    function removeRow(btn) {
        const rows = document.querySelectorAll('#product_rows tr');
        if (rows.length > 1) {
            btn.closest('tr').remove();
            updateTotal();
        }
    }

    function resetRow(index) {
        const row = document.querySelector(#product_rows tr:nth-child(${index + 1}));
        if (!row) return;
        row.querySelector('.quantity').value = 1;
        row.querySelector('.price').value = '';
        row.querySelector('.subtotal').value = '';
        row.querySelector('.product-select').selectedIndex = 0;
    }

    function updatePrice(index) {
        const select = document.getElementsByName(products[${index}][product_id])[0];
        const price = select.options[select.selectedIndex].getAttribute('data-price');
        document.getElementsByName(products[${index}][price])[0].value = price;
        updateSubtotal(index);
    }

    function updateSubtotal(index) {
        const qty = parseFloat(document.getElementsByName(products[${index}][quantity])[0].value);
        const price = parseFloat(document.getElementsByName(products[${index}][price])[0].value);
        const subtotal = qty * price;
        if (!isNaN(subtotal)) {
            document.getElementsByName(products[${index}][subtotal])[0].value = subtotal.toFixed(2);
        }
        updateTotal();
    }

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById('grand_total').innerText = total.toFixed(2);
        document.getElementById('total_amount').value = total.toFixed(2);
    }

    document.addEventListener('change', updateTotal);
</script>
@endsection