<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;

class EleveController extends Controller
{
    public function show($id): View
    {
        $eleve = User::findOrFail($id);
        // $leçons = Leçons::all();

        return view('eleves.show', ['eleve' => $eleve]);
    }

    public function update(Request $request): RedirectResponse
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
        return redirect()->route('eleves.show', ['eleve' => $request->id]);

    }
    

}
