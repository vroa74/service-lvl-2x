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
        Schema::create('service_inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
            $table->foreignId('inventory_id')->constrained('inventories')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // FK al usuario (solicitante_id del servicio)
            $table->date('service_date')->nullable(); // Fecha del servicio (F_serv del servicio)
            $table->timestamps();
            
            // Evitar duplicados: un inventario no puede tener el mismo servicio múltiples veces
            $table->unique(['service_id', 'inventory_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_inventory');
    }
};
