<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Levering Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6 grid grid-cols-[9rem_1fr] gap-y-1">
                    <div class="font-semibold">Product:</div>
                    <div>{{ $levering->ProductNaam }}</div>

                    <div class="font-semibold">Leverancier:</div>
                    <div>{{ $levering->LeverancierNaam }}</div>

                    <div class="font-semibold">Contactpersoon:</div>
                    <div>{{ $levering->ContactPersoon }}</div>

                    <div class="font-semibold">Mobiel:</div>
                    <div>{{ $levering->Mobiel }}</div>
                </div>

                <form method="POST" action="{{ route('leveranciers.levering.store', [$levering->LeverancierId, $levering->ProductId]) }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="Aantal" value="Aantal producteenheden" />
                        <x-text-input id="Aantal" name="Aantal" type="number" min="1" step="1" class="block mt-1 w-full" :value="old('Aantal')" required />
                        <x-input-error :messages="$errors->get('Aantal')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="DatumEerstvolgendeLevering" value="Datum eerstvolgende levering" />
                        <x-text-input id="DatumEerstvolgendeLevering" name="DatumEerstvolgendeLevering" type="date" class="block mt-1 w-full" :value="old('DatumEerstvolgendeLevering')" required />
                        <x-input-error :messages="$errors->get('DatumEerstvolgendeLevering')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="inline-block border border-gray-500 px-8 py-2 text-gray-800 hover:bg-gray-100">Sla op</button>

                        <div class="flex gap-4">
                            <a href="{{ route('leveranciers.producten', $levering->LeverancierId) }}" class="inline-block border border-gray-500 px-8 py-2 text-gray-800 hover:bg-gray-100">Terug</a>
                            <a href="{{ route('dashboard') }}" class="inline-block border border-gray-500 px-8 py-2 text-gray-800 hover:bg-gray-100">Home</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
