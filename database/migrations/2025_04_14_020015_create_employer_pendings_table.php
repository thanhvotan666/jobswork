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
        Schema::create('employer_pendings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('register_name');
            $table->string('address');
            $table->string('tax_code')->nullable();
            $table->enum('status',['pending','approved','rejected'])->default('pending');
            $table->text('description')->nullable();
            
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employer_pendings');
    }
};
