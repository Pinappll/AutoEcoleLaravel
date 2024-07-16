<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        // Récupère tous les utilisateurs ayant le rôle 'admin'
        $admins = User::role('admin')->get();
        return view('admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admins.create');
    }

    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        // Création d'un nouvel utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assignation du rôle 'admin' à l'utilisateur
        $user->assignRole('admin');

        return redirect()->route('admins.index')->with('success', 'Administrateur a été ajouté');
    }

    public function show($id)
    {
        // Récupération d'un utilisateur spécifique
        $admin = User::findOrFail($id);
        return view('admins.show', compact('admin'));
    }

    public function edit($id)
    {
        // Récupération d'un utilisateur spécifique pour édition
        $admin = User::findOrFail($id);
        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données du formulaire
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed'
        ]);

        // Mise à jour de l'utilisateur
        $admin = User::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();

        return redirect()->route('admins.index')->with('success', 'Administrateur a été mis à jour');
    }

    public function destroy($id)
    {
        // Suppression de l'utilisateur
        $admin = User::findOrFail($id);
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Administrateur a été supprimé');
    }
}
