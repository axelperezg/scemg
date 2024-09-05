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
        Schema::create('registers', function (Blueprint $table) {
            $table->id();

            $table->string('area');
            $table->foreignId('sector_id')->constrained('sectors');
            $table->foreignId('institution_id')->constrained('institutions');
            $table->string('type');
            $table->string('media');
            $table->string('campaign');
            $table->string('version');
            $table->string('coverage');
            $table->string('input_document');
            $table->date('date_document');
            $table->string('code');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registers');
    }
};
