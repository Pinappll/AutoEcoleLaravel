@extends('layouts.layout')

@section('content')
<div class="container p-4">
    <h1 class="font-semibold text-2xl">Bienvenue, {{ Auth::user()->name }}</h1>
    <p>Bienvenue sur votre tableau de bord des moniteurs.</p>
</div>
@endsection
