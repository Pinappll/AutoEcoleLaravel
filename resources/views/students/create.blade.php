@extends('layouts.layout')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Ajouter un Étudiant</h1>
    <form action="{{ route('students.store') }}" method="POST" class="mt-4">
        @csrf
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group mt-3">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group mt-3">
            <label for="phone_number">Numéro de téléphone :</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Ajouter</button>
    </form>
</div>
@endsection
