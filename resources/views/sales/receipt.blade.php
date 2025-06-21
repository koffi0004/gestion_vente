<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu de vente #{{ $sale->id }}</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            color: #333;
            margin: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header img {
            max-width: 100px;
        }

        .header h2 {
            margin-top: 10px;
            font-size: 24px;
        }

        .info {
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        table th {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
        }

        .print-btn {
            text-align: center;
            margin-top: 20px;
        }

        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="header">
    <!-- Logo fictif -->
    <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.style.display='none'">
    <h2>APPLICATION DE GESTION DE VENTE</h2>
    <p>Reçu de vente #{{ $sale->id }}</p>
</div>

<div class="info">
    <p><strong>Date :</strong> {{ $sale->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Client :</strong> {{ $sale->client->name ?? 'Non défini' }}</p>
    <p><strong>Téléphone :</strong> {{ $sale->client->phone ?? 'N/A' }}</p>
    <p><strong>Méthode de paiement :</strong> {{ ucfirst($sale->payment_method) }}</p>
</div>

<table>
    <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix unitaire (FCFA)</th>
            <th>Total (FCFA)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sale->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->unit_price, 0) }}</td>
                <td>{{ number_format($item->total_price, 0) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<p class="total">Montant total : {{ number_format($sale->total_amount, 0) }} FCFA</p>

<div class="print-btn">
    <button onclick="window.print()" class="btn btn-primary">🖨 Imprimer</button>
    <a href="{{ route('sales.index') }}" class="btn btn-secondary">← Retour</a>
</div>

</body>
</html>