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
        Schema::create('detalles_auditoria', function (Blueprint $table) {
            $table->id();
            
            // Campo que liga con la auditoría
            $table->string('id_aud_list');
            
            // Llave foránea a auditorias
            $table->foreignId('id_auditoria')->constrained('auditorias')->onDelete('cascade');
            
            // Campos opcionales de detalles
            $table->string('name')->nullable();
            $table->string('version')->nullable();
            $table->string('ILEGAL')->nullable();
            $table->string('fecha')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_auditoria');
    }
};
