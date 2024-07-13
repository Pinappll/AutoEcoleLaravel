<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mon espace personnel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ $eleve->adresse }}
                    <form action="{{ route('admin.updateUser', $eleve->id) }}" method="POST">
                        @csrf

                        <input type="hidden" name="id" value="{{ $eleve->id }}">
                        <input type="hidden" name="status" value="{{ $eleve->status }}">
                        <input type="hidden" name="admin" value="{{ $eleve->admin }}">

                        <div class="form-group">
                            <label for="nom">Nom complet</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ $eleve->name }}" required>
                            @error('nom')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="telephone">Téléphone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" value="{{ $eleve->phone }}" required>
                            @error('telephone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ $eleve->address }}" required>
                            @error('adresse')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $eleve->email }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
