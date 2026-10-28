<div>
    <x-input-label for="Naam" value="Naam" />
    <x-text-input id="Naam" name="Naam" type="text" class="block mt-1 w-full" :value="old('Naam', $product->Naam ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('Naam')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="Barcode" value="Barcode" />
    <x-text-input id="Barcode" name="Barcode" type="text" class="block mt-1 w-full" :value="old('Barcode', $product->Barcode ?? '')" required />
    <x-input-error :messages="$errors->get('Barcode')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="VerpakkingsEenheidinKilogram" value="Verpakkingseenheid (kg)" />
    <x-text-input id="VerpakkingsEenheidinKilogram" name="VerpakkingsEenheidinKilogram" type="text" class="block mt-1 w-full" :value="old('VerpakkingsEenheidinKilogram', $product->voorraad->VerpakkingsEenheidinKilogram ?? '')" required />
    <x-input-error :messages="$errors->get('VerpakkingsEenheidinKilogram')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="AantalAanwezig" value="Aantal aanwezig" />
    <x-text-input id="AantalAanwezig" name="AantalAanwezig" type="number" step="1" min="0" class="block mt-1 w-full" :value="old('AantalAanwezig', $product->voorraad->AantalAanwezig ?? '')" />
    <x-input-error :messages="$errors->get('AantalAanwezig')" class="mt-2" />
</div>
