<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('checkout', function (Blueprint $table) {
            $table->string('order_code')->unique();
            $table->string('snap_token')->nullable();
            $table->dateTime('paid_date')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checkout', function (Blueprint $table) {
             $table->dropColumn('order_code')->unique();
            $table->dropColumn('snap_token')->nullable();
            $table->dropColumn('paid_date')->nullable();
        });
    }
};
