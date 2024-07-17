@extends('layouts.layout')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Liste des Voitures</h1>
    <a href="{{ route('cars.create') }}" class="btn btn-primary">Ajouter une Voiture</a>
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <table class="table mt-3">
        <thead>
            <tr>
                <th class=" border-black border-4 m-2">Marque</th>
                <th class=" border-black border-4 m-2">Modèle</th>
                <th class=" border-black border-4 m-2">Immatriculation</th>
                <th class=" border-black border-4 m-2">Année</th>
                <th class=" border-black border-4 m-2">Image</th>
                <th class=" border-black border-4 m-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
                <tr>
                    <td class=" border-black border-4 m-2">{{ $car->marque }}</td>
                    <td class=" border-black border-4 m-2">{{ $car->modele }}</td>
                    <td class=" border-black border-4 m-2">{{ $car->immatriculation }}</td>
                    <td class=" border-black border-4 m-2">{{ $car->annee }}</td>
                    <td class=" border-black border-4 m-2">
                        @if($car->getFirstMediaUrl('car_images'))
                            <img src="{{ $car->getFirstMediaUrl('car_images', 'thumb') }}" alt="{{ $car->marque }}" width="100">
                        @else
                            <span>No image</span>
                        @endif
                    </td>
                    <td class="border border-black border-4 m-2">
                        <a href="{{ route('cars.show', $car->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            
            <a href="{{  route('redirectToDashboard')  }}" class="text-blue-500 hover:text-blue-700">{{ __('Retour') }}</a>

        </div>
    </div>
</div>

@endsection
