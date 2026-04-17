<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeProperty;

class TypePropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = ['Casa', 'Departamento', 'Local', 'Terreno', 'Galpón'];

        foreach ($tipos as $tipo) {
            // Busca por descripción, si no existe, la crea.
            TypeProperty::updateOrCreate(
                ['description' => $tipo], // Criterio de búsqueda
                ['description' => $tipo]  // Datos a actualizar/crear
            );
        }
    }
}
