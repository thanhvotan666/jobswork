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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('employer_id')->nullable();
            $table->string('employer_name');
            $table->string('employer_email');
            $table->string('employer_phone');
            $table->string('name');
            $table->string('type');
            $table->string('amount');
            $table->string('locale');
            $table->string('bankCode');
            $table->boolean('is_paid')->default(false);
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
