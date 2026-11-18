<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\CategoriaModel;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Categorías según las actividades obligatorias (sección 4 del enunciado).
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Inauguración',          'descripcion' => 'Apertura oficial de la Semana de Sistemas 2026.'],
            ['nombre' => 'Ponencias',             'descripcion' => 'Tema, expositor, ideas centrales y aprendizajes.'],
            ['nombre' => 'Talleres',              'descripcion' => 'Herramientas, procedimiento, práctica y resultados.'],
            ['nombre' => 'Bingo',                 'descripcion' => 'Dinámica, experiencia y participación.'],
            ['nombre' => 'Feria de proyectos',    'descripcion' => 'Proyectos visitados, tecnologías e innovación.'],
            ['nombre' => 'Comelona de pizza',     'descripcion' => 'Desarrollo, convivencia y experiencia.'],
            ['nombre' => 'Torneo de fútbol sala', 'descripcion' => 'Desarrollo, equipos y participación como jugador o espectador.'],
            ['nombre' => 'Parrillada',            'descripcion' => 'Descripción, convivencia y reflexión.'],
        ];

        foreach ($categorias as $datos) {
            CategoriaModel::updateOrCreate(['nombre' => $datos['nombre']], $datos);
        }
    }
}
