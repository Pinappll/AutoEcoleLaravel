@extends('layouts.car')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Modifier la Voiture</h1>
    <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="marque" class="form-label">Marque</label>
            <input type="text" class="form-control" id="marque" name="marque" value="{{ $car->marque }}" required>
        </div>
        <div class="mb-3">
            <label for="modele" class="form-label">Modèle</label>
            <input type="text" class="form-control" id="modele" name="modele" value="{{ $car->modele }}" required>
        </div>
        <div class="mb-3">
            <label for="immatriculation" class="form-label">Immatriculation</label>
            <input type="text" class="form-control" id="immatriculation" name="immatriculation" value="{{ $car->immatriculation }}" required>
        </div>
        <div class="mb-3">
            <label for="annee" class="form-label">Année</label>
            <input type="number" class="form-control" id="annee" name="annee" value="{{ $car->annee }}" required min="1900" max="{{ date('Y') }}">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
