<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class MoniteurController extends Controller
{
    

    public function index()
    {
        $moniteurs = User::role('moniteur')->get();
        return view('moniteurs.index', compact('moniteurs'));
    }

    public function create()
    {
        $users = User::all(); // Récupère tous les utilisateurs existants
        return view('moniteurs.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::findOrFail($request->user_id);
        $user->assignRole('moniteur');

        return redirect()->route('moniteurs.index')->with('success', 'Moniteur ajouté');
    }

    public function show($id)
    {
        $moniteur = User::findOrFail($id);
        return view('moniteurs.show', compact('moniteur'));
    }

    public function edit($id)
    {
        $moniteur = User::findOrFail($id);
        return view('moniteurs.edit', compact('moniteur'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed'
        ]);

        $moniteur = User::findOrFail($id);
        $moniteur->name = $request->name;
        $moniteur->email = $request->email;
        if ($request->filled('password')) {
            $moniteur->password = Hash::make($request->password);
        }
        $moniteur->save();

        return redirect()->route('moniteurs.index')->with('success', 'Moniteur mis à jour');
    }

    public function destroy($id)
    {
        $moniteur = User::findOrFail($id);
        $moniteur->removeRole('moniteur');
        $moniteur->delete();
        return redirect()->route('moniteurs.index')->with('success', 'Moniteur supprimé');
    }
}
