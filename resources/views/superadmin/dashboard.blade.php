<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{  route('redirectToDashboard')  }}"> {{ __('Dashboard') }} </a> | <a href="{{  url('/')  }}"> {{ __('Retour au site') }} </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-orange-900 dark:text-gray-100">
                   
                        <a href="{{ route('moniteurs.index') }}" class="text-blue-500 hover:text-blue-700">{{ __('Liste des moniteurs') }}</a>
                </div>
            </div>
        </div>
        <br>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   
                    <a href="{{ route('cars.index') }}" class="text-blue-500 hover:text-blue-700">{{ __('Liste des voitures') }}</a>

                </div>
            </div>
        </div>
        <br>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   
                    <a href="{{ route('students.index') }}" class="text-blue-500 hover:text-blue-700">{{ __('Liste des élèves') }}</a>

                </div>
            </div>
        </div>
        <br>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   

                    <a href="{{ route('lessons.index') }}" class="text-blue-500 hover:text-blue-700">{{ __('Liste des leçons') }}</a>


                </div>
            </div>
        </div>
        <br>
        @role('superadmin')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   
                    <a href="{{ route('admins.index') }}" class="text-blue-500 hover:text-blue-700">{{ __('Liste des admins') }}</a>

                </div>
            </div>
        </div>
        @endrole
    </div>
</x-app-layout>
