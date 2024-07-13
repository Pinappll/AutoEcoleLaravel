<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Espace Administrateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div style = "text-align: center;"><h1>Tous les élèves</h1></div>
                <a href="{{ route('admin.create') }}" class="text-blue-500 hover:text-blue-700">{{ __('Nouveau') }}</a>
                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">{{ __('Nom et Prenom') }}</th>
                                <th class="px-4 py-2">{{ __('Email') }}</th>
                                <th class="px-4 py-2">{{ __('Valider') }}</th>
                                <th class="px-4 py-2">{{ __('Nombre de leçon') }}</th>
                                <th class="px-4 py-2">{{ __('Editer') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eleves as $eleve)
                                <tr>
                                    <td class="border px-4 py-2">{{ $eleve->name }}</td>
                                    <td class="border px-4 py-2">{{ $eleve->email }}</td>
                                    <td class="border px-4 py-2">{{ $eleve->validation ? 'OUI' : 'NON' }}</td>
                                    <td class="border px-4 py-2">0</td>
                                    <td class="border px-4 py-2">
                                    <a href="{{ route('admin.editUser', $eleve->id) }}" class="text-blue-500 hover:text-blue-700">{{ __('Éditer') }}</a> 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div style = "text-align: center;"><h1>Tous les Moniteurs</h1></div>
                <!-- <a href="{{ route('admin.create') }}" class="text-blue-500 hover:text-blue-700">{{ __('Nouveau') }}</a> -->
                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">{{ __('Nom et Prenom') }}</th>
                                <th class="px-4 py-2">{{ __('Email') }}</th>
                                <th class="px-4 py-2">{{ __('Editer') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($moniteurs as $moniteur)
                                <tr>
                                    <td class="border px-4 py-2">{{ $moniteur->name }}</td>
                                    <td class="border px-4 py-2">{{ $moniteur->email }}</td>
                                    <td class="border px-4 py-2">
                                    <a href="{{ route('admin.editUser', $moniteur->id) }}" class="text-blue-500 hover:text-blue-700">{{ __('Éditer') }}</a> 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
