@extends('layouts.layout')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Ajouter un Administrateur</h1>
    <form action="{{ route('admins.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">Sélectionner un Utilisateur :</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            
            <a href="{{  route('redirectToDashboard')  }}" class="text-blue-500 hover:text-blue-700">{{ __('Retour') }}</a>

        </div>
    </div>
</div>
@endsection
