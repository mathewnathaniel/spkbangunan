<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ranking_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->decimal('final_score', 10, 6)->default(0); // nilai akhir SAW
            $table->unsignedInteger('ranking')->default(0);
            $table->json('detail_scores')->nullable(); // detail perhitungan normalisasi
            $table->timestamps();

            $table->unique('brand_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ranking_results');
    }
};
