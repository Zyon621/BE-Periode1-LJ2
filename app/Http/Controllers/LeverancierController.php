<?php

namespace App\Http\Controllers;

use App\Models\LeverancierModel;
use Illuminate\View\View;

class LeverancierController extends Controller
{
    public function __construct(private LeverancierModel $leverancierModel)
    {
    }

    public function index(): View
    {
        $leveranciers = $this->leverancierModel->getOverzicht();

        return view('leveranciers.index', compact('leveranciers'));
    }

    public function producten(int $leverancierId): View
    {
        $leverancier = $this->leverancierModel->getById($leverancierId);

        abort_if($leverancier === null, 404);

        $producten = $this->leverancierModel->getGeleverdeProducten($leverancierId);

        return view('leveranciers.producten', compact('leverancier', 'producten'));
    }
}
