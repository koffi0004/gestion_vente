<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('sales', function (Blueprint $table) {
            $table->timestamp('canceled_at')->nullable()->after('note');
            $table->string('cancellation_reason')->nullable()->after('canceled_at');
        });
    }

    public function down(): void {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('canceled_at');
            $table->dropColumn('cancellation_reason');
        });
    }
};
