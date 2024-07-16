@extends('layouts.layout')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Détails du Moniteur</h1>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Nom : {{ $moniteur->name }}</h5>
            <p class="card-text">Email : {{ $moniteur->email }}</p>
            <p class="card-text">Numéro de téléphone : {{ $moniteur->phone_number }}</p>
            <a href="{{ route('moniteurs.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection
