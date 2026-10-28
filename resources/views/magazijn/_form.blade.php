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
    <x-input-label for="VerpakkingsEenheid" value="Verpakkingseenheid (kg)" />
    <x-text-input id="VerpakkingsEenheid" name="VerpakkingsEenheid" type="number" step="0.1" min="0" class="block mt-1 w-full" :value="old('VerpakkingsEenheid', $product->magazijn->VerpakkingsEenheid ?? '')" required />
    <x-input-error :messages="$errors->get('VerpakkingsEenheid')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="AantalAanwezig" value="Aantal aanwezig" />
    <x-text-input id="AantalAanwezig" name="AantalAanwezig" type="number" step="1" min="0" class="block mt-1 w-full" :value="old('AantalAanwezig', $product->magazijn->AantalAanwezig ?? '')" />
    <x-input-error :messages="$errors->get('AantalAanwezig')" class="mt-2" />
</div>
