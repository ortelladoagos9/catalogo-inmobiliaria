<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PropertyOwner;

class PropertyOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PropertyOwner::insert([
            [
                'id_number' => '30123456',
                'name' => 'Juan Pérez',
                'email' => 'juan@example.com',
                'phone_number' => '3794234567'
            ],
            [
                'id_number' => '30986532',
                'name' => 'Ana López',
                'email' => 'ana@example.com',
                'phone_number' => '3794567890'
            ],
            [
                'id_number' => '30987654',
                'name' => 'María Gómez',
                'email' => 'maria@example.com',
                'phone_number' => '3419876543'
            ]
        ]);
    }
}
