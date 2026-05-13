<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brand_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->decimal('harga', 8, 2)->default(0);      // nilai kriteria harga (1-10)
            $table->decimal('kualitas', 8, 2)->default(0);   // nilai kriteria kualitas (1-10)
            $table->decimal('minat_pasar', 8, 2)->default(0);// nilai kriteria minat pasar (1-10)
            $table->timestamps();

            $table->unique('brand_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brand_scores');
    }
};
