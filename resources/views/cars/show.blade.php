@extends('layouts.car')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Détails de la Voiture</h1>
    <div class="card">
        <div class="card-header">
            Voiture #{{ $car->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $car->marque }} {{ $car->modele }}</h5>
            <p class="card-text">Immatriculation : {{ $car->immatriculation }}</p>
            <p class="card-text">Année : {{ $car->annee }}</p>
            @if($car->getFirstMediaUrl('car_images'))
                <p class="card-text">
                    <img src="{{ $car->getFirstMediaUrl('car_images') }}" alt="{{ $car->marque }}" width="200">
                </p>
            @else
                <span>No image</span>
            @endif
            <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning">Modifier</a>
            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection
