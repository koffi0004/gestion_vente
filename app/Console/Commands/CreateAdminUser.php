<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create 
                            {--name=Admin : Nom de l\'utilisateur} 
                            {--email=admin@example.com : Email de l\'admin} 
                            {--password=password123 : Mot de passe de l\'admin}';

    protected $description = 'Créer un utilisateur administrateur manuellement';

    public function handle()
    {
        $user = User::create([
            'name' => $this->option('name'),
            'email' => $this->option('email'),
            'email_verified_at' => now(),
            'password' => Hash::make($this->option('password')),
        ]);

        $this->info('✔ Utilisateur admin créé avec succès :');
        $this->line('📧 Email : ' . $user->email);
        $this->line('🔑 Mot de passe : ' . $this->option('password'));
    }
}