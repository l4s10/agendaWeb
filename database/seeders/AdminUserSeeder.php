<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un nuevo usuario administrador
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'), // Asegúrate de cambiar la contraseña
        ]);

        // Asignar el rol de administrador al usuario
        $adminRole = Role::findByName('administrador');
        $adminUser->assignRole($adminRole);
    }
}
