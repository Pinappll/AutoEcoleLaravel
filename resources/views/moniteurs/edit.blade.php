@extends('layouts.layout')

@section('content')
    <h1>Modifier le Moniteur</h1>
    <form action="{{ route('moniteurs.update', $moniteur->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" value="{{ $moniteur->name }}" required>
        </div>
        <div>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="{{ $moniteur->email }}" required>
        </div>
        <div>
            <label for="phone_number">Numéro de téléphone :</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ $moniteur->phone_number }}" required>
        </div>
        <button type="submit">Mettre à jour</button>
    </form>
@endsection
