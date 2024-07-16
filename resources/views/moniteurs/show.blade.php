@extends('layouts.layout')

@section('content')
    <h1>Détails du Moniteur</h1>
    <p>Nom : {{ $moniteur->name }}</p>
    <p>Email : {{ $moniteur->email }}</p>
    <p>Numéro de téléphone : {{ $moniteur->phone_number }}</p>
    <a href="{{ route('moniteurs.index') }}">Retour à la liste</a>
@endsection
