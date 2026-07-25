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
        // Solo agregar 'observacion' si no existe en 'responsivas'
        if (!Schema::hasColumn('responsivas', 'observacion')) {
            Schema::table('responsivas', function (Blueprint $table) {
                $table->string('observacion')->nullable()->after('auditoria');
            });
        }

        // Solo agregar 'observacion' si no existe en 'inventory_responsivas'
        if (!Schema::hasColumn('inventory_responsivas', 'observacion')) {
            Schema::table('inventory_responsivas', function (Blueprint $table) {
                $table->string('observacion')->nullable()->after('description');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('responsivas', 'observacion')) {
            Schema::table('responsivas', function (Blueprint $table) {
                $table->dropColumn('observacion');
            });
        }

        if (Schema::hasColumn('inventory_responsivas', 'observacion')) {
            Schema::table('inventory_responsivas', function (Blueprint $table) {
                $table->dropColumn('observacion');
            });
        }
    }
};
