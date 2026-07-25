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
        Schema::create('auditorias', function (Blueprint $table) {
            $table->id();
            
            // Llaves foráneas a usuarios (pueden ser nulas excepto idres, idoic e idinfo)
            $table->foreignId('iduser')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('idres')->constrained('users')->onDelete('cascade');
            $table->foreignId('idoic')->constrained('users')->onDelete('cascade');
            $table->foreignId('idinfo')->constrained('users')->onDelete('cascade');
            
            // Campo único para enlazar con detalles_auditoria
            $table->string('id_aud_list', 64)->unique();
            
            // Fecha y hora de la auditoría (formato 24 horas)
            $table->dateTime('FH');
            
            // Llave foránea a inventarios
            $table->foreignId('ni')->constrained('inventories')->onDelete('cascade');
            
            // Campo de detalles para uso discrecional
            $table->text('PCDetalle')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditorias');
    }
};
