@extends('layouts.lesson')

@section('content')
<div class="container">
    <h1>Modifier la Leçon</h1>
    <form action="{{ route('lessons.update', $lesson->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $lesson->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $lesson->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $lesson->date }}" required>
        </div>
        <div class="mb-3">
            <label for="start_time" class="form-label">Heure de début</label>
            <input type="time" class="form-control" id="start_time" name="start_time" value="{{ $lesson->start_time }}" required>
        </div>
        <div class="mb-3">
            <label for="end_time" class="form-label">Heure de fin</label>
            <input type="time" class="form-control" id="end_time" name="end_time" value="{{ $lesson->end_time }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
