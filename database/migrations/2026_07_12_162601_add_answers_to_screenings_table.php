<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('screenings', function (Blueprint $table) {
            // Menambahkan kolom answers bertipe JSON (bisa kosong untuk data lama)
            $table->json('answers')->nullable()->after('status'); 
        });
    }

    public function down()
    {
        Schema::table('screenings', function (Blueprint $table) {
            $table->dropColumn('answers');
        });
    }
};
