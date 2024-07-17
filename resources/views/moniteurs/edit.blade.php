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
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            
            <a href="{{  route('redirectToDashboard') }}" class="text-blue-500 hover:text-blue-700">{{ __('Retour') }}</a>

        </div>
    </div>
</div>
@endsection
