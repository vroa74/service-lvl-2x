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
        Schema::create('old_inventies', function (Blueprint $table) {
            $table->id();
            $table->string('fecha_inv', 12)->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // relación con users
            $table->foreignId('res_id')->nullable()->constrained('users')->nullOnDelete(); // relación con users
            $table->date('fecha')->nullable();
            $table->string('dir', 40)->nullable();
            $table->string('resguardante', 70)->nullable();
            $table->string('user', 140)->nullable();
            $table->boolean('is_pc')->default(false);
            $table->string('gpo', 20)->nullable();
            $table->string('disp', 30)->nullable();
            $table->string('type', 30)->nullable();
            $table->string('articulo', 35)->nullable();
            $table->string('ni', 35)->nullable();
            $table->string('marca', 35)->nullable();
            $table->string('modelo', 35)->nullable();
            $table->string('ns', 35)->nullable();
            $table->string('nombres', 50)->nullable();
            $table->string('apa', 35)->nullable();
            $table->string('ama', 35)->nullable();
            $table->string('fullname')->nullable();
            $table->text('software_instalado')->nullable();
            $table->text('info_pc')->nullable();
            $table->text('observaciones')->nullable();                
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('old_inventies');
    }
};
