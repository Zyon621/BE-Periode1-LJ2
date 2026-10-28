<?php

namespace App\Http\Controllers;

use App\Models\LeveringModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeveringController extends Controller
{
    public function __construct(private LeveringModel $leveringModel)
    {
    }

    public function create(int $leverancierId, int $productId): View
    {
        $levering = $this->leveringModel->getLeveringProduct($leverancierId, $productId);

        abort_if($levering === null, 404);

        return view('leveringen.create', compact('levering'));
    }

    public function store(Request $request, int $leverancierId, int $productId): RedirectResponse|View
    {
        $levering = $this->leveringModel->getLeveringProduct($leverancierId, $productId);

        abort_if($levering === null, 404);

        $validated = $request->validate([
            'Aantal' => ['required', 'integer', 'min:1', 'max:10000'],
            'DatumEerstvolgendeLevering' => ['required', 'date'],
        ]);

        $resultaat = $this->leveringModel->voegLeveringToe(
            $leverancierId,
            $productId,
            (int) $validated['Aantal'],
            $validated['DatumEerstvolgendeLevering'],
        );

        abort_if($resultaat->Succes != 1 && $resultaat->Reden === 'ONBEKEND', 404);

        if ($resultaat->Reden === 'NIET_ACTIEF') {
            $melding = "Het product {$levering->ProductNaam} van de leverancier {$levering->LeverancierNaam} wordt niet meer geproduceerd";

            return view('leveringen.create', compact('levering', 'melding'));
        }

        return redirect()
            ->route('leveranciers.producten', $leverancierId)
            ->with('status', "De levering van {$levering->ProductNaam} is opgeslagen.");
    }
}
