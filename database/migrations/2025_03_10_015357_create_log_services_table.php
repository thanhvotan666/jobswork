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
        Schema::create('log_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('employer_id');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedInteger('quantity')->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('expired')->nullable();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_services');
    }
};
