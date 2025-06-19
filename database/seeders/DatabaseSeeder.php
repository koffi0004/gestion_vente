<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Créer un utilisateur
        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        

        // ✅ Créer des clients
        Client::factory()->count(10)->create();

        // ✅ Créer des produits
        $products = [
            ['name' => 'Savon', 'code' => 'P001', 'unit' => 'pièce', 'purchase_price' => 200, 'sale_price' => 300, 'stock_quantity' => 50],
            ['name' => 'Riz', 'code' => 'P002', 'unit' => 'kg', 'purchase_price' => 400, 'sale_price' => 600, 'stock_quantity' => 25],
            ['name' => 'Huile', 'code' => 'P003', 'unit' => 'litre', 'purchase_price' => 800, 'sale_price' => 1000, 'stock_quantity' => 12],
            ['name' => 'Sucre', 'code' => 'P004', 'unit' => 'kg', 'purchase_price' => 500, 'sale_price' => 750, 'stock_quantity' => 8],
            ['name' => 'Spaghetti', 'code' => 'P005', 'unit' => 'paquet', 'purchase_price' => 250, 'sale_price' => 350, 'stock_quantity' => 30],
        ];

        foreach ($products as $data) {
            Product::create($data);
        }

        // ✅ Créer une vente test
        $client = Client::first();
        $product1 = Product::find(1);
        $product2 = Product::find(2);

        $sale = Sale::create([
            'user_id' => $user->id,
            'client_id' => $client->id,
            'payment_method' => 'cash',
            'total_amount' => $product1->sale_price * 2 + $product2->sale_price,
            'note' => 'Vente test',
        ]);

        SaleItem::create([
            'sale_id' => $sale->id,
            'product_id' => $product1->id,
            'quantity' => 2,
            'unit_price' => $product1->sale_price,
            'total_price' => $product1->sale_price * 2
        ]);

        SaleItem::create([
            'sale_id' => $sale->id,
            'product_id' => $product2->id,
            'quantity' => 1,
            'unit_price' => $product2->sale_price,
            'total_price' => $product2->sale_price
        ]);

        // ✅ Mettre à jour les stocks
        $product1->decrement('stock_quantity', 2);
        $product2->decrement('stock_quantity', 1);
    }
}