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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('id_s', 25)->unique();
            $table->date('F_serv')->nullable();
            // FK: usuarios - CAMBIADOS A REQUERIDOS            
            $table->foreignId('solicitante_id')->constrained('users');
            $table->foreignId('efectuo_id')->constrained('users');
            $table->foreignId('vobo_id')->constrained('users');
			//datos dek servicio
            $table->text('obj_sol')->nullable();
            $table->text('actividades')->nullable();
            $table->text('observaciones')->nullable();
            $table->text('mantenimiento')->nullable();
            //tipo de servicio
            $table->boolean('correctivo')->default(0);
            $table->boolean('preventivo')->default(0);
            $table->boolean('transparencia')->default(0);
            $table->boolean('a_tec')->default(0);
            $table->boolean('web_ins')->default(0);
            $table->boolean('print')->default(0);
            //via de solicitud
            $table->boolean('email')->default(0);
            $table->boolean('tel')->default(0);
            $table->boolean('sol_ser')->default(0);
            $table->boolean('oficio')->default(0);
            $table->boolean('calendario')->default(0);
                        
            $table->foreignId('capturo')->constrained('users');
            $table->boolean('status')->default(false);
            $table->boolean('impressions')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
