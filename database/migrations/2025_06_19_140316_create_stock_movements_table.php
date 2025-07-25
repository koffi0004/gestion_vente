<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['in', 'out']); // entrée ou sortie
            $table->integer('quantity');
            $table->text('reason')->nullable(); // perte, réappro, casse
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('stock_movements');
    }
};