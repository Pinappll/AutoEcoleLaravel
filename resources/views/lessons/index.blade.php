@extends('layouts.lesson')

@section('content')
<div class="container">
    <h1>Liste des Leçons</h1>
    <a href="{{ route('lessons.create') }}" class="btn btn-primary">Ajouter une Leçon</a>
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lessons as $lesson)
                <tr>
                    <td>{{ $lesson->title }}</td>
                    <td>{{ $lesson->description }}</td>
                    <td>{{ $lesson->date }}</td>
                    <td>{{ $lesson->start_time }}</td>
                    <td>{{ $lesson->end_time }}</td>
                    <td>
                        <a href="{{ route('lessons.show', $lesson->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
</table>
</div>
@endsection
