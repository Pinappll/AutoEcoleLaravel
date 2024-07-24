@extends('layouts.layout')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Bienvenue, {{ Auth::user()->name }}</h1>
    <p>Bienvenue sur votre tableau de bord des moniteurs.</p>
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
