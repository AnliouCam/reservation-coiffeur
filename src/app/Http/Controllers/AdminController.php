<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->date ?? today()->format('Y-m-d');

        $reservations = Reservation::with(['service', 'creneau'])
            ->whereHas('creneau', fn($q) => $q->where('date', $date))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.dashboard', compact('reservations', 'date'));
    }

    public function updateStatut(Request $request, Reservation $reservation)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,confirmee,annulee',
        ]);

        $reservation->update(['statut' => $request->statut]);

        return back();
    }
}
