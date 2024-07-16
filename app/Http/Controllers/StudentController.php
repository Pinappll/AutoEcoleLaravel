<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    

    public function index()
    {
        $students = User::role('eleve')->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $users = User::all(); // Récupère tous les utilisateurs existants
        return view('students.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::findOrFail($request->user_id);
        $user->assignRole('eleve');

        return redirect()->route('students.index')->with('success', 'Élève ajouté');
    }

    public function show($id)
    {
        $student = User::findOrFail($id);
        return view('students.show', compact('student'));
    }

    public function edit($id)
    {
        $student = User::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed'
        ]);

        $student = User::findOrFail($id);
        $student->name = $request->name;
        $student->email = $request->email;
        if ($request->filled('password')) {
            $student->password = Hash::make($request->password);
        }
        $student->save();

        return redirect()->route('students.index')->with('success', 'Élève mis à jour');
    }

    public function destroy($id)
    {
        $student = User::findOrFail($id);
        $student->removeRole('eleve');
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Élève supprimé');
    }
}
