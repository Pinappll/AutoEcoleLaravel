@extends('layouts.layout')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Détails de l'Administrateur</h1>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Nom : {{ $admin->name }}</h5>
            <p class="card-text">Email : {{ $admin->email }}</p>
            <a href="{{ route('admins.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection
