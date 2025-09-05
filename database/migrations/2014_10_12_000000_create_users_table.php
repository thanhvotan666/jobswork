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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('date_of_birth')->nullable();
            $table->string('sex')->nullable();
            $table->string('desired_location')->nullable();
            $table->string('position')->nullable();
            $table->boolean('job_search_status')->default(false);
            $table->text('introduce')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('location')->nullable();
            $table->string('degree')->nullable();
            $table->decimal('current_salary', 15, 2)->nullable();
            $table->decimal('desired_salary', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
