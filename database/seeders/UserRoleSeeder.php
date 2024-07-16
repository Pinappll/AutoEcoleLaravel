<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        // Assigner les rôles aux utilisateurs existants
        $superadmin = User::find(1); // Assurez-vous que l'utilisateur avec l'ID 1 existe
        if ($superadmin) {
            $superadmin->assignRole('superadmin');
        }

        $admin = User::find(2); // Assurez-vous que l'utilisateur avec l'ID 2 existe
        if ($admin) {
            $admin->assignRole('admin');
        }

        $moniteur = User::find(4); // Assurez-vous que l'utilisateur avec l'ID 3 existe
        if ($moniteur) {
            $moniteur->assignRole('moniteur');
        }

        $eleve = User::find(3); // Assurez-vous que l'utilisateur avec l'ID 4 existe
        if ($eleve) {
            $eleve->assignRole('eleve');
        }
    }
}
