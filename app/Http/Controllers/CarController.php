<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'immatriculation' => 'required|string|max:255|unique:cars',
            'annee' => 'required|integer|min:1900|max:' . date('Y'),
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024' // Validation de l'image
        ]);

        $car = Car::create($request->all());

        if ($request->hasFile('image')) {
            $car->addMedia($request->file('image'))->toMediaCollection('car_images');
        }

        return redirect('/cars')->with('success', 'La voiture a bien été ajoutée');
    }

    public function show($id)
    {
        $car = Car::find($id);
        return view('cars.show', compact('car'));
    }

    public function edit($id)
    {
        $car = Car::find($id);
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'immatriculation' => 'required|string|max:255|unique:cars,immatriculation,' . $id,
            'annee' => 'required|integer|min:1900|max:' . date('Y'),
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:1024' // Validation de l'image
        ]);

        $car = Car::find($id);
        $car->update($request->all());

        if ($request->hasFile('image')) {
            $car->clearMediaCollection('car_images'); // Supprime l'ancienne image
            $car->addMedia($request->file('image'))->toMediaCollection('car_images');
        }

        return redirect('/cars')->with('success', 'La voiture a été mise à jour');
    }

    public function destroy($id)
    {
        $car = Car::find($id);
        $car->delete();
        return redirect('/cars')->with('success', 'La voiture a été supprimée');
    }
}

