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
        Schema::create('strategies', function (Blueprint $table) {
            $table->id();

            $table->string('anio');
            $table->string('partidaPresupuestal');
            $table->string('mision');
            $table->string('vision');
            $table->foreignId('sector_id')->constrained('sectors');
            $table->foreignId('institution_id')->constrained('institutions');
            $table->string('objetivoInstitucional');
            $table->string('objetivoEstrategiaComunicacion');
            $table->foreignId('plan_id')->constrained('plans');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('subcategory_id')->constrained('subcategories');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strategies');
    }
};
