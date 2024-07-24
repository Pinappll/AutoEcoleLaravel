<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('create:user {name}', function ($name) {
    $email = strtolower($name) . '@mail.fr';
    $password = 'Test1234';

    $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => Hash::make($password),
    ]);

    $this->info("L'utilisateur $name a été créé avec succès avec l'adresse email $email et le mot de passe Test1234");
})->purpose('Créer un nouvel utilisateur');