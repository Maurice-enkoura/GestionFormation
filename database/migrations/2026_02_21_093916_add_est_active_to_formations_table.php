<?php
// database/migrations/xxxx_xx_xx_add_est_active_to_formations_table.php

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
        Schema::table('formations', function (Blueprint $table) {
            // Ajoute la colonne est_active après date_fin avec valeur par défaut true
            $table->boolean('est_active')->default(true)->after('date_fin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formations', function (Blueprint $table) {
            $table->dropColumn('est_active');
        });
    }
};