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
        Schema::create('tbl_alternatif', function (Blueprint $table) {
            $table->id('alternatif_id');
            $table->foreignId('balita_id')->constrained('tbl_balita', 'balita_id')->onDelete('cascade');
            $table->date('tanggal_pengukuran');
            $table->integer('umur_bulan');
            $table->float('tb', 8, 2);
            $table->float('bb', 8, 2);
            $table->float('tb_zscore', 8, 2);
            $table->float('bb_zscore', 8, 2);
            $table->enum('asi', ['Eksklusif', 'Tidak Eksklusif', 'Tidak Diberikan']);
            $table->enum('mpasi', ['Diberikan', 'Tidak Diberikan']);
            $table->enum('sanitasi', ['Layak', 'Sebagian Layak', 'Tidak Layak']);
            $table->enum('penyakit', ['Tidak Pernah', 'Jarang', 'Sering']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_alternatif');
    }
};
