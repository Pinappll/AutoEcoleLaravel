@extends('layouts.layout')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Détails de l'Étudiant</h1>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Nom : {{ $student->name }}</h5>
            <p class="card-text">Email : {{ $student->email }}</p>
            <p class="card-text">Numéro de téléphone : {{ $student->phone_number }}</p>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection
