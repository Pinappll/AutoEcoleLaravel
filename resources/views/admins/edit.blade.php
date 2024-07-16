@extends('layouts.layout')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Modifier l'Administrateur</h1>
    <form action="{{ route('admins.update', $admin->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $admin->name }}" required>
        </div>
        <div class="form-group mt-3">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $admin->email }}" required>
        </div>
        <div class="form-group mt-3">
            <label for="password">Mot de passe (laisser vide pour ne pas changer) :</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group mt-3">
            <label for="password_confirmation">Confirmation du mot de passe :</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary mt-4">Mettre à jour</button>
    </form>
</div>
@endsection
