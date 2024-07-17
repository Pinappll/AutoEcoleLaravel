@extends('layouts.layout')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Détails de l'Élève</h1>
    <p><strong>Nom :</strong> {{ $student->name }}</p>
    <p><strong>Email :</strong> {{ $student->email }}</p>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Retour à la liste</a>
    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Modifier</a>
    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
</div>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            
            <a href="{{ route('redirectToDashboard')  }}" class="text-blue-500 hover:text-blue-700">{{ __('Retour') }}</a>

        </div>
    </div>
</div>
@endsection
