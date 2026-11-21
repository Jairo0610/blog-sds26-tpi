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
        Schema::create('evidencias', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['fotografia', 'constancia', 'registro_asistencia', 'otro'])->default('fotografia');
            $table->string('ruta_archivo');
            $table->text('descripcion')->nullable();
            $table->date('fecha');
            $table->timestamps();
            $table->foreignId('actividad_id')->constrained('actividades')->cascadeOnDelete();
            $table->foreignId('usuario_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('post_id')->nullable()->constrained('posts')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evidencias');
    }
};
