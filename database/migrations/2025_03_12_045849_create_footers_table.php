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
        Schema::create('footers', function (Blueprint $table) {
            $table->id();
            $table->string('company')->nullable();
            $table->string('address_n')->nullable();
            $table->string('address_s')->nullable();
            $table->string('phone_n')->nullable();
            $table->string('phone_s')->nullable();
            $table->string('email')->nullable();
            $table->string('hotline')->nullable();
            $table->text('bottom')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('threads')->nullable();
            $table->string('zalo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footers');
    }
};
