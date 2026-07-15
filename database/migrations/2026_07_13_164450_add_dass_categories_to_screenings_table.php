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
            // Menambahkan 6 kolom baru untuk 3 kategori DASS
            $table->integer('score_depresi')->nullable()->after('status');
            $table->string('status_depresi')->nullable()->after('score_depresi');
            
            $table->integer('score_kecemasan')->nullable()->after('status_depresi');
            $table->string('status_kecemasan')->nullable()->after('score_kecemasan');
            
            $table->integer('score_stres')->nullable()->after('status_kecemasan');
            $table->string('status_stres')->nullable()->after('score_stres');
        });
    }

    public function down()
    {
        Schema::table('screenings', function (Blueprint $table) {
            $table->dropColumn([
                'score_depresi', 'status_depresi', 
                'score_kecemasan', 'status_kecemasan', 
                'score_stres', 'status_stres'
            ]);
        });
    }
};
