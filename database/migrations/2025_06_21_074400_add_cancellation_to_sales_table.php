<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('sales', function (Blueprint $table) {
        $table->timestamp('canceled_at')->nullable();
        $table->text('cancellation_reason')->nullable();
    });
}

public function down()
{
    Schema::table('sales', function (Blueprint $table) {
        $table->dropColumn(['canceled_at', 'cancellation_reason']);
    });
}
};
