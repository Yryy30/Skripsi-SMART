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
        Schema::create('lhfa', function (Blueprint $table) {
            $table->id();
            $table->string('month');
            $table->string('gender');
            $table->decimal('mean', 8, 2);
            $table->decimal('sd', 8, 2);
            $table->decimal('minus_3sd', 8, 2);
            $table->decimal('minus_2sd', 8, 2);
            $table->decimal('minus_1sd', 8, 2);
            $table->decimal('median', 8, 2);
            $table->decimal('plus_1sd', 8, 2);
            $table->decimal('plus_2sd', 8, 2);
            $table->decimal('plus_3sd', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lhfa');
    }
};
