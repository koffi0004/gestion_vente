<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>État du stock</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>État du stock</h2>
    <table>
        <thead>
            <tr>
                
                <th>Produit</th>
                <th>Stock disponible</th>
                <th>Prix de vente</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->stock_quantity }}</td>
                    <td>{{ number_format($product->sale_price, 0) }} FCFA</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>