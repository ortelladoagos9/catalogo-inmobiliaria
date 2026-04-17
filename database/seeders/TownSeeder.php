<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Town;
use App\Models\Province;

class TownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $corrientes = Province::where('name', 'Corrientes')->first();
        $chaco = Province::where('name', 'Chaco')->first();
        $formosa = Province::where('name', 'Formosa')->first();

        Town::insert([
            ['name' => 'Corrientes Capital', 'province_id' => $corrientes->id, 'postal_code' => 3400],
            ['name' => 'Resistencia', 'province_id' => $chaco->id, 'postal_code' => 3500],
            ['name' => 'Formosa Capital', 'province_id' => $formosa->id, 'postal_code' => 3600],
        ]);
    }
}
