<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
}
