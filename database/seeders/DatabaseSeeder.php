<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Lesson;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Appel du seeder pour les rôles et permissions
        $this->call(RolePermissionSeeder::class);

        // Récupérer tous les rôles disponibles
        $roles = Role::all();

        // Crée 10 utilisateurs avec des données aléatoires et leur assigner des rôles aléatoires
        User::factory(10)->create()->each(function ($user) use ($roles) {
            // Assigner un rôle aléatoire à chaque utilisateur
            $user->assignRole($roles->random()->name);
        });

        // Vérifier et créer un utilisateur spécifique avec le rôle 'superadmin'
        $superadmin = User::firstOrCreate(
            ['email' => 'superadmin@mail.fr'],
            ['name' => 'Super Admin', 'password' => bcrypt('SuperAdmin1234')] // Ajouter d'autres champs si nécessaire
        );
        $superadmin->assignRole('superadmin');

        // Vérifier et créer un utilisateur spécifique avec le rôle 'admin'
        $admin = User::firstOrCreate(
            ['email' => 'admin@mail.fr'],
            ['name' => 'Admin User', 'password' => bcrypt('Admin1234')] // Ajouter d'autres champs si nécessaire
        );
        $admin->assignRole('admin');
        // Vérifier et créer un utilisateur spécifique avec le rôle 'admin'
        $admin = User::firstOrCreate(
            ['email' => 'moniteur@mail.fr '],
            ['name' => 'Admin User', 'password' => bcrypt('Moniteur1234')] // Ajouter d'autres champs si nécessaire
        );
        $admin->assignRole('moniteur');
        // Vérifier et créer un utilisateur spécifique avec le rôle 'admin'
        $admin = User::firstOrCreate(
            ['email' => 'eleve@mail.fr'],
            ['name' => 'Admin User', 'password' => bcrypt('Eleve1234')] // Ajouter d'autres champs si nécessaire
        );
        $admin->assignRole('eleve');


        // Crée 10 voitures factices
        $cars = Car::factory(10)->create();

        // Crée 10 leçons factices en utilisant les voitures créées
        Lesson::factory(10)->create([
            'car_id' => $cars->random()->id, // Assigner une voiture aléatoire à chaque leçon
        ]);
    }
}
