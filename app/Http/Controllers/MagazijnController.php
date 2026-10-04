<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Voorraad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MagazijnController extends Controller
{
    public function overzicht(): View
    {
        $producten = Product::where('IsActief', 1)
            ->with('voorraad')
            ->orderBy('Barcode')
            ->get();

        return view('magazijn.overzicht', compact('producten'));
    }

    public function create(): View
    {
        return view('magazijn.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProduct($request);

        $now = now();

        $product = Product::create([
            'Naam' => $validated['Naam'],
            'Barcode' => $validated['Barcode'],
            'IsActief' => 1,
            'DatumAangemaakt' => $now,
            'DatumGewijzigd' => $now,
        ]);

        Voorraad::create([
            'Productid' => $product->Id,
            'VerpakkingsEenheidinKilogram' => $validated['VerpakkingsEenheidinKilogram'],
            'AantalAanwezig' => $validated['AantalAanwezig'] ?? null,
            'IsActief' => 1,
            'DatumAangemaakt' => $now,
            'DatumGewijzigd' => $now,
        ]);

        return redirect()->route('magazijn.overzicht')->with('status', 'Product aangemaakt.');
    }

    private function validateProduct(Request $request, ?Product $product = null): array
    {
        return $request->validate([
            'Naam' => ['required', 'string', 'max:50'],
            'Barcode' => [
                'required', 'string', 'max:13',
                Rule::unique('product', 'Barcode')->ignore($product?->Id, 'Id'),
            ],
            'VerpakkingsEenheidinKilogram' => ['required', 'string', 'max:10'],
            'AantalAanwezig' => ['nullable', 'numeric', 'min:0'],
        ]);
    }
}
