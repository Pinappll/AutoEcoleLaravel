@extends('layouts.layout')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Liste des Étudiants</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary">Ajouter un Étudiant</a>
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <table class="table mt-3">
        <thead>
            <tr>
                <th class="border border-black border-4 m-2">Nom</th>
                <th class="border border-black border-4 m-2">Email</th>
                <th class="border border-black border-4 m-2">Numéro de téléphone</th>
                <th class="border border-black border-4 m-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td class="border border-black border-4 m-2">{{ $student->name }}</td>
                    <td class="border border-black border-4 m-2">{{ $student->email }}</td>
                    <td class="border border-black border-4 m-2">{{ $student->phone_number }}</td>
                    <td class="border border-black border-4 m-2">
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
   <a href="{{ route('dashboard') }}" class="text-blue-500 hover:text-blue-700">{{ __('Retour') }}</a>

                
</div>
@endsection
