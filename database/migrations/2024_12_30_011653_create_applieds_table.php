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
        Schema::create('applieds', function (Blueprint $table) {
            $table->id();

            $table->string('attachment')->nullable();
            //new suitable contact interview offer success failed
            $table->string('status')->default('new');
            $table->boolean('show_contact')->default(false);
            $table->boolean('viewed')->default(false);


            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('job_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applieds');
    }
};
