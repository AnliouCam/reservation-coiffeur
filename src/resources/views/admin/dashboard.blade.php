@extends('layouts.app')

@section('title', 'Dashboard Admin — Salon de Coiffure')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div class="flex items-center gap-6">
            <h1 class="text-3xl font-bold">Tableau de bord</h1>
            <a href="/admin/creneaux" class="text-sm text-gray-500 hover:text-gray-900 transition">Gérer les créneaux →</a>
        </div>
        <form method="GET" action="/admin" class="flex items-center gap-3">
            <input type="date" name="date" value="{{ $date }}"
                   class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400">
            <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-700 transition">
                Filtrer
            </button>
        </form>
    </div>

    @if($reservations->isEmpty())
        <p class="text-gray-400">Aucune réservation pour cette date.</p>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-900 text-white">
                    <tr>
                        <th class="px-5 py-4 text-left">Client</th>
                        <th class="px-5 py-4 text-left">Service</th>
                        <th class="px-5 py-4 text-left">Heure</th>
                        <th class="px-5 py-4 text-left">Téléphone</th>
                        <th class="px-5 py-4 text-left">Statut</th>
                        <th class="px-5 py-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($reservations as $reservation)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-4">
                                <div class="font-semibold">{{ $reservation->client_nom }}</div>
                                <div class="text-gray-400 text-xs">{{ $reservation->client_email }}</div>
                            </td>
                            <td class="px-5 py-4">{{ $reservation->service->nom }}</td>
                            <td class="px-5 py-4">{{ \Carbon\Carbon::parse($reservation->creneau->heure)->format('H\hi') }}</td>
                            <td class="px-5 py-4">{{ $reservation->client_telephone }}</td>
                            <td class="px-5 py-4">
                                @if($reservation->statut === 'confirmee')
                                    <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Confirmée</span>
                                @elseif($reservation->statut === 'annulee')
                                    <span class="bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">Annulée</span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">En attente</span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <form method="POST" action="/admin/reservations/{{ $reservation->id }}/statut">
                                    @csrf
                                    @method('PATCH')
                                    <select name="statut" onchange="this.form.submit()"
                                            class="border border-gray-300 rounded-lg px-3 py-1 text-sm focus:outline-none">
                                        <option value="en_attente" {{ $reservation->statut === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                        <option value="confirmee" {{ $reservation->statut === 'confirmee' ? 'selected' : '' }}>Confirmée</option>
                                        <option value="annulee" {{ $reservation->statut === 'annulee' ? 'selected' : '' }}>Annulée</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
