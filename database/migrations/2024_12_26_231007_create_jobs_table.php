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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('degree');
            $table->unsignedInteger('experience');
            $table->string('address');
            $table->string('location');
            $table->text('description');
            $table->text('requirement');
            $table->text('benefits');
            $table->date('expired');
            $table->string('demand')->default('fulltime');
            $table->unsignedInteger('min_salary')->nullable();
            $table->unsignedInteger('max_salary')->nullable();
            $table->string('type_salary')->default('million VND');
            $table->unsignedBigInteger('view')->default(0);
            
            $table->boolean('is_stop')->default(false);

            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');

            $table->unsignedBigInteger('employer_id');
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
