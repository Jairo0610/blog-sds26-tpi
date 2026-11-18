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
        Schema::create('posts', function (Blueprint $table) {
            $table->string('titulo', 200);
            $table->string('slug', 220)->unique();
            $table->date('fecha_actividad');
            $table->string('resumen', 300)->nullable();
            $table->longText('contenido');
            $table->string('imagen_principal')->nullable();
            $table->enum('estado', ['borrador', 'publicado'])->default('borrador');
            $table->timestamp('publicado_en')->nullable();
            $table->timestamps();
            $table->index(['estado', 'publicado_en']);
            $table->foreignId('usuario_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('categoria_id')->constrained('categorias') ->restrictOnDelete();
            $table->foreignId('actividad_id')->nullable()->constrained('actividades')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
