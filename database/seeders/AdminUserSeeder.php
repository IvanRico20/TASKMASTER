<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear el rol 'admin' si no existe
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        // Crear el usuario administrador
        $adminUser = User::create([
            'name' => 'Administrador',
            'email' => 'taskmaster962@gmail.com',
            'password' => bcrypt('TaskMaster20'), // Cambia la contraseña si lo deseas
        ]);

        // Asignar el rol 'admin' al usuario
        $adminUser->assignRole('admin');
    }
}
