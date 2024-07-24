<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    // Le nom et la signature de la commande console
    protected $signature = 'user:create {name}';

    // La description de la commande console
    protected $description = 'Créer un nouvel utilisateur ';

    // Exécution de la commande console
    public function handle()
    {
        // Récupération de l'argument
        $name = $this->argument('name');
        
        // Construction de l'adresse email
        $email = strtolower($name) . '@mail.fr';

        // Création de l'utilisateur
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make('Test1234'),
        ]);

        // Message de succès
        $this->info("L'utilisateur $name a été créé avec succès avec l'adresse email $email et le mot de passe Test1234");

        return 0;
    }
}
