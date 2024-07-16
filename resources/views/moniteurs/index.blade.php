@extends('layouts.layout')

@section('content')
    <h1>Liste des Moniteurs</h1>
    <a href="{{ route('moniteurs.create') }}">Ajouter un Moniteur</a>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Numéro de téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($moniteurs as $moniteur)
                <tr>
                    <td>{{ $moniteur->name }}</td>
                    <td>{{ $moniteur->email }}</td>
                    <td>{{ $moniteur->phone_number }}</td>
                    <td>
                        <a href="{{ route('moniteurs.show', $moniteur->id) }}">Voir</a>
                        <a href="{{ route('moniteurs.edit', $moniteur->id) }}">Modifier</a>
                        <form action="{{ route('moniteurs.destroy', $moniteur->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
