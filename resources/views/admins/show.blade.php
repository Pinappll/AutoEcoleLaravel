@extends('layouts.layout')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Détails de l'Administrateur</h1>
    <p><strong>Nom :</strong> {{ $admin->name }}</p>
    <p><strong>Email :</strong> {{ $admin->email }}</p>
    <a href="{{ route('admins.index') }}" class="btn btn-secondary">Retour à la liste</a>
    <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-warning">Modifier</a>
    <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
</div>
@endsection
