<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
        ['email' => 'ortelladoagos@gmail.com'],
        [
            'name' => 'Admin Evolvere',
            'email' => 'ortelladoagos@gmail.com',
            'password' => bcrypt('admin123'),
            'profile_id' => 1 // ID del Administrador
        ]);
        
        User::updateOrCreate(
        ['email' => 'operario@test.com'],
        [
            'name' => 'Operario Evolvere',
            'email' => 'operario@test.com',
            'password' => bcrypt('ope123'),
            'profile_id' => 2 // ID del Operario
        ]);
    }
}
