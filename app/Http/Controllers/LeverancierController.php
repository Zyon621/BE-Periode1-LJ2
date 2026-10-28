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
}
