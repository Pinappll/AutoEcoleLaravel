@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Liste des Leçons</h1>
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
@php
    $user = Auth::user();
@endphp

@if ($user->hasRole('admin'))
    <a href="{{ url('/admin/dashboard') }}" class="text-blue-500 hover:text-blue-700">{{ __('Retour') }}</a>
@elseif ($user->hasRole('superadmin'))
    <a href="{{ url('/superadmin/dashboard') }}" class="text-blue-500 hover:text-blue-700">{{ __('Retour') }}</a>
@endif
@endsection
