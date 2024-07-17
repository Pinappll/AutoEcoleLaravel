@extends('layouts.layout')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Liste des Élèves</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary">Ajouter un Élève</a>
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
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
