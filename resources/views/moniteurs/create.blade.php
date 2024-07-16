@extends('layouts.layout')

@section('content')
    <h1>Ajouter un Moniteur</h1>
    <form action="{{ route('moniteurs.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="phone_number">Numéro de téléphone :</label>
            <input type="text" name="phone_number" id="phone_number" required>
        </div>
        <button type="submit">Ajouter</button>
    </form>
@endsection
