@extends('layouts.lesson')

@section('content')
<div class="container">
    <h1>Détails de la Leçon</h1>
    <div class="card">
        <div class="card-header">
            Leçon #{{ $lesson->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $lesson->title }}</h5>
            <p class="card-text">Description : {{ $lesson->description }}</p>
            <p class="card-text">Date : {{ $lesson->date }}</p>
            <p class="card-text">Heure de début : {{ $lesson->start_time }}</p>
            <p class="card-text">Heure de fin : {{ $lesson->end_time }}</p>
            <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-warning">Modifier</a>
            <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection
