<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Créer des rôles s'ils n'existent pas déjà
        if (!Role::where('name', 'superadmin')->exists()) {
            Role::create(['name' => 'superadmin']);
        }
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }
        if (!Role::where('name', 'moniteur')->exists()) {
            Role::create(['name' => 'moniteur']);
        }
        if (!Role::where('name', 'eleve')->exists()) {
            Role::create(['name' => 'eleve']);
        }

        // Créer des permissions s'ils n'existent pas déjà
        if (!Permission::where('name', 'manage admins')->exists()) {
            Permission::create(['name' => 'manage admins']);
        }
        if (!Permission::where('name', 'manage moniteurs')->exists()) {
            Permission::create(['name' => 'manage moniteurs']);
        }
        if (!Permission::where('name', 'manage eleves')->exists()) {
            Permission::create(['name' => 'manage eleves']);
        }

        // Assigner des permissions aux rôles
        $superadmin = Role::findByName('superadmin');
        $superadmin->syncPermissions(['manage admins', 'manage moniteurs', 'manage eleves']);

        $admin = Role::findByName('admin');
        $admin->syncPermissions(['manage moniteurs', 'manage eleves']);
    }
}
