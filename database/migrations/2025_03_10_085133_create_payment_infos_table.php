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
        Schema::create('payment_infos', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name');          // Tên ngân hàng
            $table->string('account_name');       // Tên chủ tài khoản
            $table->string('account_number');     // Số tài khoản ngân hàng
            $table->string('qr_code')->nullable(); // Đường dẫn ảnh mã QR
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_infos');
    }
};
