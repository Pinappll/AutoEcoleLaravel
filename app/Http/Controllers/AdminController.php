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
        $admins = User::role('admin')->get();
        return view('admins.index', compact('admins'));
    }

    public function create()
    {
        // Exclure les utilisateurs avec n'importe quel rôle
        $users = User::whereDoesntHave('roles')->get();
        return view('admins.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::findOrFail($request->user_id);
        $user->assignRole('admin');

        return redirect()->route('admins.index')->with('success', 'Administrateur ajouté');
    }

    public function show($id)
    {
        $admin = User::findOrFail($id);
        return view('admins.show', compact('admin'));
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed'
        ]);

        $admin = User::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();

        return redirect()->route('admins.index')->with('success', 'Administrateur mis à jour');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->removeRole('admin');
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Administrateur supprimé');
    }
}
