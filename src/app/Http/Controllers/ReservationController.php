<?php

namespace App\Http\Controllers;

use App\Models\Creneau;
use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create(Request $request)
    {
        $service = Service::findOrFail($request->service);
        $creneau = Creneau::findOrFail($request->creneau);

        return view('reserver.formulaire', compact('service', 'creneau'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_nom'       => 'required|string|max:100',
            'client_email'     => 'required|email',
            'client_telephone' => 'required|string|max:20',
            'service_id'       => 'required|exists:services,id',
            'creneau_id'       => 'required|exists:creneaux,id',
        ]);

        $creneau = Creneau::findOrFail($request->creneau_id);
        $creneau->update(['disponible' => false]);

        $reservation = Reservation::create([
            'client_nom'       => $request->client_nom,
            'client_email'     => $request->client_email,
            'client_telephone' => $request->client_telephone,
            'service_id'       => $request->service_id,
            'creneau_id'       => $request->creneau_id,
            'statut'           => 'en_attente',
        ]);

        return redirect("/reserver/confirmation?reservation={$reservation->id}");
    }
}
