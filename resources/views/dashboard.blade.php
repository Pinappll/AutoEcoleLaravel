<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(auth()->user()->admin)
                        <a href="{{ route('admin') }}" class="text-blue-500 hover:text-blue-700">{{ __('Administration') }}</a>
                    @else
                        <a href="{{ route('eleves.show', ['eleve' => auth()->user()->id]) }}" class="text-blue-500 hover:text-blue-700">{{ __('Mon espace personnel') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
