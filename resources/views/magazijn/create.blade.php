<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nieuw product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('magazijn.store') }}">
                    @csrf
                    @include('magazijn._form')

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('magazijn.overzicht') }}" class="underline text-sm text-gray-600 mr-4">Annuleren</a>
                        <x-primary-button>Opslaan</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
