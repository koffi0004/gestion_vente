<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Création des rôles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $caissier = Role::firstOrCreate(['name' => 'caissier']);
        $employe = Role::firstOrCreate(['name' => 'employe']);

        // Création ou récupération d’un utilisateur admin par défaut
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'), // change-le après
            ]
        );

        // Assignation du rôle admin
        $user->assignRole($admin);
    }
}