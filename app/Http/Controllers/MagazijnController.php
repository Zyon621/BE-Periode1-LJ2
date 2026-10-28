<?php

namespace App\Http\Controllers;

use App\Models\Magazijn;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MagazijnController extends Controller
{
    public function overzicht(): View
    {
        $producten = Product::where('IsActief', 1)
            ->with('magazijn')
            ->orderBy('Barcode')
            ->get();

        return view('magazijn.overzicht', compact('producten'));
    }

    public function leveringInfo(Product $product): View
    {
        $leveringen = $product->leveringen()
            ->with('leverancier')
            ->orderBy('DatumLevering')
            ->get();

        return view('magazijn.levering-info', compact('product', 'leveringen'));
    }

    public function allergenenInfo(Product $product): View
    {
        $allergenen = $product->allergenen()->get();

        return view('magazijn.allergenen-info', compact('product', 'allergenen'));
    }

    public function create(): View
    {
        return view('magazijn.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProduct($request);

        $product = Product::create([
            'Naam' => $validated['Naam'],
            'Barcode' => $validated['Barcode'],
            'IsActief' => 1,
        ]);

        Magazijn::create([
            'ProductId' => $product->Id,
            'VerpakkingsEenheid' => $validated['VerpakkingsEenheid'],
            'AantalAanwezig' => $validated['AantalAanwezig'] ?? null,
            'IsActief' => 1,
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
            'VerpakkingsEenheid' => ['required', 'numeric', 'min:0', 'max:999.9'],
            'AantalAanwezig' => ['nullable', 'numeric', 'min:0'],
        ]);
    }
}
