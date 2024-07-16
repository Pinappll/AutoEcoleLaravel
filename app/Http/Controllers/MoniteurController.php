<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Moniteur;

class MoniteurController extends Controller
{
    public function index()
    {
        $moniteurs = Moniteur::all();
        return view('moniteurs.index', compact('moniteurs'));
    }

    public function create()
    {
        return view('moniteurs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:moniteurs',
            'phone_number' => 'required'
        ]);

        $moniteur = new Moniteur([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone_number' => $request->get('phone_number')
        ]);

        $moniteur->save();
        return redirect('/moniteurs')->with('success', 'Le Moniteur a bien été ajouter');
    }

    public function show($id)
    {
        $moniteur = Moniteur::find($id);
        return view('moniteurs.show', compact('moniteur'));
    }

    public function edit($id)
    {
        $moniteur = Moniteur::find($id);
        return view('moniteurs.edit', compact('moniteur'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:moniteurs,email,'.$id,
            'phone_number' => 'required'
        ]);

        $moniteur = Moniteur::find($id);
        $moniteur->name = $request->get('name');
        $moniteur->email = $request->get('email');
        $moniteur->phone_number = $request->get('phone_number');

        $moniteur->save();
        return redirect('/moniteurs')->with('success', 'Le Moniteur a été mis à jour');
    }

    public function destroy($id)
    {
        $moniteur = Moniteur::find($id);
        $moniteur->delete();
        return redirect('/moniteurs')->with('success', 'LE Moniteur a été supprimer');
    }
}
