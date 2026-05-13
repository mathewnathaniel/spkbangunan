<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ahp_comparisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criteria_1_id')->constrained('criterias')->cascadeOnDelete();
            $table->foreignId('criteria_2_id')->constrained('criterias')->cascadeOnDelete();
            $table->decimal('value', 8, 4)->default(1); // nilai perbandingan berpasangan AHP
            $table->timestamps();

            $table->unique(['criteria_1_id', 'criteria_2_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ahp_comparisons');
    }
};
