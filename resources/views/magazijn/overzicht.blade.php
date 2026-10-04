<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Overzicht Magazijn Jamin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-gray-300">
                            <th class="py-2 pr-4">Barcode</th>
                            <th class="py-2 pr-4">Naam</th>
                            <th class="py-2 pr-4">Verpakkingseenheid</th>
                            <th class="py-2 pr-4">Aantal aanwezig</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($producten as $product)
                            <tr class="border-b border-gray-200">
                                <td class="py-2 pr-4">{{ $product->Barcode }}</td>
                                <td class="py-2 pr-4">{{ $product->Naam }}</td>
                                <td class="py-2 pr-4">{{ $product->voorraad->VerpakkingsEenheidinKilogram ?? '-' }} kg</td>
                                <td class="py-2 pr-4">{{ $product->voorraad->AantalAanwezig ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
