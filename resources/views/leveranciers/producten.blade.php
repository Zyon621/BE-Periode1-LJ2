<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Geleverde producten') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6 grid grid-cols-[12rem_1fr] gap-y-1 max-w-xl">
                    <div class="font-semibold">Naam leverancier</div>
                    <div>: {{ $leverancier->Naam }}</div>

                    <div class="font-semibold">Contactpersoon</div>
                    <div>: {{ $leverancier->ContactPersoon }}</div>

                    <div class="font-semibold">Leverancier NR</div>
                    <div>: {{ $leverancier->LeverancierNummer }}</div>

                    <div class="font-semibold">Mobiel</div>
                    <div>: {{ $leverancier->Mobiel }}</div>
                </div>

                <table class="w-full text-left border border-gray-400 border-collapse">
                    <thead>
                        <tr class="border-b border-gray-400">
                            <th class="py-2 px-3 border-r border-gray-400">Naam product</th>
                            <th class="py-2 px-3 border-r border-gray-400">Aantal in Magazijn</th>
                            <th class="py-2 px-3 border-r border-gray-400">Verpakkingseenheid</th>
                            <th class="py-2 px-3 border-r border-gray-400">Laatste levering</th>
                            <th class="py-2 px-3 text-center">Nieuwe levering</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($producten as $product)
                            <tr class="border-b border-gray-400">
                                <td class="py-2 px-3 border-r border-gray-400">{{ $product->ProductNaam }}</td>
                                <td class="py-2 px-3 border-r border-gray-400">{{ $product->AantalAanwezig ?? 0 }}</td>
                                <td class="py-2 px-3 border-r border-gray-400">{{ rtrim(rtrim(number_format((float) $product->VerpakkingsEenheid, 1, ',', ''), '0'), ',') }} kg</td>
                                <td class="py-2 px-3 border-r border-gray-400">{{ \Carbon\Carbon::parse($product->DatumLaatsteLevering)->format('d-m-Y') }}</td>
                                <td class="py-2 px-3 text-center">
                                    <span title="Nieuwe levering" class="text-xl font-bold">+</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="flex justify-end gap-4 mt-6">
                    <a href="{{ route('leveranciers.index') }}" class="inline-block border border-gray-500 px-10 py-2 text-gray-800 hover:bg-gray-100">Terug</a>
                    <a href="{{ route('dashboard') }}" class="inline-block border border-gray-500 px-10 py-2 text-gray-800 hover:bg-gray-100">Home</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
