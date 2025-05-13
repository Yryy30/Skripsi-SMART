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
        Schema::create('tbl_kriteria', function (Blueprint $table) {
            $table->id('kriteria_id');
            $table->string('kriteria_nama');
            $table->string('kriteria_atribut');
            $table->integer('kriteria_bobot')->nullable();
            $table->float('kriteria_bobot_normalisasi', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriterias');
    }
};
