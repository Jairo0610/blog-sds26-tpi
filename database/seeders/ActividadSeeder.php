<?php

namespace Database\Seeders;

use App\Models\Actividad;
use App\Models\ActividadModel;
use App\Models\Categoria;
use App\Models\CategoriaModel;
use Illuminate\Database\Seeder;

class ActividadSeeder extends Seeder
{
    /**
     * Itinerario oficial SDS26 · Green IoT (16 al 20 de noviembre de 2026).
     */
    public function run(): void
    {
        $categoria = fn (string $nombre) => CategoriaModel::where('nombre', $nombre)->value('id');

        $actividades = [
            ['Inauguración', 'Inauguración', '¡Comienza el evento!', '2026-11-16 08:00', 'Auditorio 1'],
            ['Ponencias', 'Ponencia 1', 'Investigación aplicada en IoT para la agricultura en El Salvador.', '2026-11-16 10:00', 'Auditorio 1'],
            ['Ponencias', 'Ponencia 2', 'Energías alternativas y eficiencia energética.', '2026-11-16 13:00', 'Auditorio 1'],
            ['Ponencias', 'Ponencia 3', 'Eficiencia energética, optimización de recursos y sostenibilidad aplicada a soluciones tecnológicas.', '2026-11-17 08:00', 'Auditorio 1'],
            ['Ponencias', 'Ponencia 4', 'Ciberseguridad ESET', '2026-11-17 10:00', 'Auditorio 1'],
            ['Talleres', 'Taller', 'Sostenibilidad digital y análisis energético mediante Electricity Map.', '2026-11-17 13:00', 'Auditorio 1'],
            ['Bingo', 'Bingo', 'Bingo de la Semana de Sistemas.', '2026-11-18 08:00', 'Auditorio 1'],
            ['Feria de proyectos', 'Expo Systems', 'Los proyectos más innovadores realizados por los estudiantes de Ingeniería de Sistemas Informáticos.', '2026-11-19 08:00', 'Plaza Minerva'],
            ['Comelona de pizza', 'Comelona de pizza', '¿Eres tan veloz para ganar?', '2026-11-19 12:00', 'Plaza Minerva'],
            ['Torneo de fútbol sala', 'Torneo futsal', 'Partidos frenéticos, 5 jugadores por equipo.', '2026-11-20 08:00', 'Cancha futsal'],
            ['Parrillada', 'Parrillada', 'Un momento para disfrutar todos y convivir.', '2026-11-20 12:00', 'Alrededores de la cancha'],
        ];

        foreach ($actividades as [$nombreCategoria, $nombre, $descripcion, $fechaHora, $lugar]) {
            ActividadModel::updateOrCreate(
                ['nombre' => $nombre, 'fecha_hora' => $fechaHora],
                [
                    'categoria_id' => $categoria($nombreCategoria),
                    'descripcion' => $descripcion,
                    'lugar' => $lugar,
                ]
            );
        }
    }
}
