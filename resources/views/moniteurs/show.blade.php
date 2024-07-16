@extends('layouts.layout')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Détails du Moniteur</h1>
    <p><strong>Nom :</strong> {{ $moniteur->name }}</p>
    <p><strong>Email :</strong> {{ $moniteur->email }}</p>
    <a href="{{ route('moniteurs.index') }}" class="btn btn-secondary">Retour à la liste</a>
    <a href="{{ route('moniteurs.edit', $moniteur->id) }}" class="btn btn-warning">Modifier</a>
    <form action="{{ route('moniteurs.destroy', $moniteur->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
</div>
@endsection
