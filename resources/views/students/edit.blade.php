@extends('layouts.layout')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Modifier l'Étudiant</h1>
    <form action="{{ route('students.update', $student->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $student->name }}" required>
        </div>
        <div class="form-group mt-3">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $student->email }}" required>
        </div>
        <div class="form-group mt-3">
            <label for="phone_number">Numéro de téléphone :</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $student->phone_number }}" required>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Mettre à jour</button>
    </form>
</div>
@endsection
