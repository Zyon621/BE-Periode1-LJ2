<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Overzicht leveranciers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border border-gray-400 border-collapse">
                    <thead>
                        <tr class="border-b border-gray-400">
                            <th class="py-2 px-3 border-r border-gray-400">Naam</th>
                            <th class="py-2 px-3 border-r border-gray-400">Contactpersoon</th>
                            <th class="py-2 px-3 border-r border-gray-400">Leveranciernummer</th>
                            <th class="py-2 px-3 border-r border-gray-400">Mobiel</th>
                            <th class="py-2 px-3 border-r border-gray-400 text-center">Aantal verschillende producten</th>
                            <th class="py-2 px-3 text-center">Toon producten</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leveranciers as $leverancier)
                            <tr class="border-b border-gray-400">
                                <td class="py-2 px-3 border-r border-gray-400">{{ $leverancier->Naam }}</td>
                                <td class="py-2 px-3 border-r border-gray-400">{{ $leverancier->ContactPersoon }}</td>
                                <td class="py-2 px-3 border-r border-gray-400">{{ $leverancier->LeverancierNummer }}</td>
                                <td class="py-2 px-3 border-r border-gray-400">{{ $leverancier->Mobiel }}</td>
                                <td class="py-2 px-3 border-r border-gray-400 text-center">{{ $leverancier->AantalVerschillendeProducten }}</td>
                                <td class="py-2 px-3 text-center">
                                    <span title="Toon producten" class="inline-block text-gray-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                        </svg>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('dashboard') }}" class="inline-block border border-gray-500 px-10 py-2 text-gray-800 hover:bg-gray-100">Home</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
