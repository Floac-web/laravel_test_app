<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Services\NovaPoshtaService;
use Illuminate\Http\Request;

class NovaPoshtaController extends Controller
{
    public function index(Request $request, NovaPoshtaService $service)
    {
        $cities = City::with('wareHouses')->paginate(10);

        return view('novaposhta.index', compact('cities'));
    }
}
