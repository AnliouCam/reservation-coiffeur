@extends('layouts.app')

@section('title', 'Réservation confirmée — Salon de Coiffure')

@section('content')
    <div class="max-w-lg mx-auto text-center">
        <div class="text-5xl mb-4">✓</div>
        <h1 class="text-3xl font-bold mb-2">Réservation enregistrée !</h1>
        <p class="text-gray-500 mb-10">Merci {{ $reservation->client_nom }}, votre demande a bien été prise en compte.</p>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-left">
            <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">Récapitulatif</h2>
            <table class="w-full text-sm">
                <tr class="border-b border-gray-100">
                    <td class="py-3 text-gray-400">Service</td>
                    <td class="py-3 font-semibold">{{ $reservation->service->nom }}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <td class="py-3 text-gray-400">Date</td>
                    <td class="py-3 font-semibold">{{ \Carbon\Carbon::parse($reservation->creneau->date)->format('d/m/Y') }}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <td class="py-3 text-gray-400">Heure</td>
                    <td class="py-3 font-semibold">{{ \Carbon\Carbon::parse($reservation->creneau->heure)->format('H\hi') }}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <td class="py-3 text-gray-400">Prix</td>
                    <td class="py-3 font-semibold">{{ number_format($reservation->service->prix, 2) }} €</td>
                </tr>
                <tr>
                    <td class="py-3 text-gray-400">Statut</td>
                    <td class="py-3">
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">
                            En attente de confirmation
                        </span>
                    </td>
                </tr>
            </table>
        </div>

        <a href="/" class="inline-block mt-8 bg-gray-900 text-white px-8 py-3 rounded-lg hover:bg-gray-700 transition">
            Retour à l'accueil
        </a>
    </div>
@endsection
