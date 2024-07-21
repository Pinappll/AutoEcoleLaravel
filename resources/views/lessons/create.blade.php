@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Ajouter une Leçon</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('lessons.store') }}" method="POST">
        @csrf
        <input type="hidden" value="{{ $id_user }}" name="student_id">
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="mb-3">
            <label for="start_time" class="form-label">Heure de début</label>
            <input type="time" class="form-control" id="start_time" name="start_time" required>
        </div>
        <div class="mb-3">
            <label for="end_time" class="form-label">Heure de fin</label>
            <input type="time" class="form-control" id="end_time" name="end_time" required>
        </div>
        <div class="mb-3">
            <label for="moniteur_id" class="form-label">Moniteur</label>
            <select class="form-control" id="moniteur_id" name="moniteur_id">
                @foreach($moniteurs as $moniteur)
                    <option value="{{ $moniteur->id }}">{{ $moniteur->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="car_id" class="form-label">Voiture</label>
            <select class="form-control" id="car_id" name="car_id">
                @foreach($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->marque }} {{ $car->modele }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
