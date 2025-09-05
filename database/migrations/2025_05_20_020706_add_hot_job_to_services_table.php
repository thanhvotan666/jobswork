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
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('price_discount');
            $table->boolean('hot_job')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->unsignedDecimal('price', 15, 2)->default(0);
            $table->unsignedDecimal('price_discount', 15, 2)->nullable();
            $table->dropColumn('hot_job');
        });
    }
};
