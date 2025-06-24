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
        Schema::create('responsivas', function (Blueprint $table) {
            $table->id();
                // usuario que recibe el equipo (puede ser null)
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            // responsable
            $table->foreignId('responsable_id')->constrained('users')->nullOnDelete();
            // informático
            $table->foreignId('informatica_id')->constrained('users')->nullOnDelete();
            $table->date('fecha')->nullable(); // fecha de emisión
            $table->string('codigo', 20)->unique(); // generado por el user, por ejemplo: RESP-0001
            $table->boolean('auditoria')->default(false); // auditoría sí o no
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responsivas');
    }
};
