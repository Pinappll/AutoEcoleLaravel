@extends('layouts.layout')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Modifier le Moniteur</h1>
    <form action="{{ route('moniteurs.update', $moniteur->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $moniteur->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $moniteur->email }}" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe (laisser vide pour conserver le mot de passe actuel) :</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmer le mot de passe :</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('moniteurs.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
