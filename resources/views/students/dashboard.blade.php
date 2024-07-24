@extends('layouts.layout')

@section('content')
<div class="container p-4">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="font-semibold text-2xl">Bienvenue, {{ Auth::user()->name }}</h1>
    <p>Bienvenue sur votre tableau de bord des élèves.</p>
    <a href="{{ route('lessons.create') }}" class="btn btn-primary">Ajouter une Leçon</a>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id='calendar'></div>
        </div>
    </div>
    
</div>
<script>
    localStorage.setItem('authToken', '{{ $authToken }}');
</script>
@endsection