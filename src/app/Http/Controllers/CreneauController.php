<?php

namespace App\Http\Controllers;

use App\Models\Creneau;
use App\Models\Service;
use Illuminate\Http\Request;

class CreneauController extends Controller
{
    public function index(Request $request)
    {
        $service = Service::findOrFail($request->service);
        $date = $request->date ?? today()->format('Y-m-d');

        $creneaux = Creneau::where('date', $date)
            ->where('disponible', true)
            ->orderBy('heure')
            ->get();

        return view('reserver.creneaux', compact('service', 'date', 'creneaux'));
    }
}
