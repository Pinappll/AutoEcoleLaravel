<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;


class AdminController extends Controller
{
    public function index()
    {
        $eleves = User::where('status', 'eleve')->get();
        $moniteurs = User::where('status', 'moniteur')->get();
        // $voitures = Voiture::all();

        return view('index', compact('eleves', 'moniteurs'));
    }

    public function edit($id): View
    {
        $eleve = User::findOrFail($id);
        return view('admin.editUser', ['eleve' => $eleve]);
    }

    public function create()
    {
        return view('eleves.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'status' => 'required',
            'email' => 'required|email|unique:eleves',
            'mot_de_passe' => 'required|min:8|confirmed',
        ]);

        $user = new User();
        $user->name = $request->nom;
        $user->email = $request->email;
        if($request->status == "admin"){
            $user->admin = true;
            $user->status = $request->status;
        }else{
            $user->status = $request->status;
            $user->admin = false;
        }
        $user->password = Hash::make($request->mot_de_passe);
        $user->save();

        return redirect()->route('admin')->with('success', 'Élève ajouté avec succès.');

        
    }

    public function updateUser(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required',
            'mot_de_passe' => 'nullable|min:8',
        ]);
        
        $user = User::findOrFail($request->id);
        $user->name = $request->nom;
        $user->email = $request->email;
        $user->address = $request->adresse;
        $user->phone = $request->telephone;
        $user->admin = $request->admin ?? $user->admin;
        $user->status = $request->status ?? $user->status;
    
        if ($request->filled('mot_de_passe')) {
            $user->password = Hash::make($request->mot_de_passe);
        }
    
        $user->save();
        return redirect()->route('admin');

    }
}
