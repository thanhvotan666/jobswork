<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('job_views', function (Blueprint $table) {
            $table->boolean('show_contact')->default(false);
        });
    }

    public function down()
    {
        Schema::table('job_views', function (Blueprint $table) {
            $table->dropColumn('show_contact');
        });
    }
};
