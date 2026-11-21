<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Integrante al que pertenece la evidencia. NULL significa que corresponde a ambos integrantes.
     */
    public function up(): void
    {
        Schema::table('post_images', function (Blueprint $table) {
            $table->foreignId('usuario_id')->nullable()->after('post_id')->constrained('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_images', function (Blueprint $table) {
            $table->dropConstrainedForeignId('usuario_id');
        });
    }
};
