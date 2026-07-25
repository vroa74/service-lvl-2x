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
        Schema::create('black_lists', function (Blueprint $table) {
            $table->id();
            
            // Campos de la tabla BlackList
            $table->string('name', 70)->nullable();
            $table->string('tipo', 70)->nullable();
            $table->integer('STATUS')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('black_lists');
    }
};
