<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pharmacies_products', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->nullable()->after('pharmacy_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pharmacies_products', function (Blueprint $table) {
            $table->dropColumn('price');

        });
    }
};