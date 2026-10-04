<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Overzicht Allergenen') }} — {{ $product->Naam }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="mb-6 grid grid-cols-2 gap-2 max-w-md">
                        <div class="font-semibold">Naam Product:</div>
                        <div>{{ $product->Naam }}</div>

                        <div class="font-semibold">Barcode:</div>
                        <div>{{ $product->Barcode }}</div>
                    </div>

                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b-2 border-gray-300">
                                <th class="py-2 pr-4">Naam</th>
                                <th class="py-2 pr-4">Omschrijving</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allergenen as $allergeen)
                                <tr class="border-b border-gray-200">
                                    <td class="py-2 pr-4">{{ $allergeen->Naam }}</td>
                                    <td class="py-2 pr-4">{{ $allergeen->Omschrijving }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                <p class="mt-6"><a class="underline text-indigo-600" href="{{ route('magazijn.overzicht') }}">Terug naar overzicht</a></p>
            </div>
        </div>
    </div>
</x-app-layout>
