<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Integrantes de la pareja (únicos usuarios del área administrativa).
     * Cambia nombres, carnés, correos y contraseñas por los reales.
     */
    public function run(): void
    {
        $members = [
            ['name' => 'Jairo Alexander Argueta Alvarenga', 'carnet' => 'AA23027', 'email' => 'aa23027@ues.edu.sv'],
            ['name' => 'Yanira Verenice Martínez Aguilar', 'carnet' => 'MA22013', 'email' => 'ma22013@ues.edu.sv'],
        ];

        foreach ($members as $member) {
            User::updateOrCreate(
                ['email' => $member['email']],
                $member + ['password' => '12345']
            );
        }
    }
}
