@extends('layouts.layout')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Liste des Administrateurs</h1>
    <a href="{{ route('admins.create') }}" class="btn btn-primary">Ajouter un Administrateur</a>
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
            @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        <a href="{{ route('admins.show', $admin->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display:inline;">
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
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            
            <a href="{{ route('redirectToDashboard')  }}" class="text-blue-500 hover:text-blue-700">{{ __('Retour') }}</a>

        </div>
    </div>
</div>
@endsection
