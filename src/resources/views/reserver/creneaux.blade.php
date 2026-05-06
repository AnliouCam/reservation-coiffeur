@extends('layouts.app')

@section('title', 'Choisir un créneau — Salon de Coiffure')

@section('content')
    <h1 class="text-3xl font-bold mb-1">Choisir un créneau</h1>
    <p class="text-gray-500 mb-8">
        Service : <span class="font-semibold text-gray-700">{{ $service->nom }}</span>
        — {{ $service->duree }} min
        — {{ number_format($service->prix, 2) }} €
    </p>

    <form method="GET" action="/reserver/creneaux" class="flex items-center gap-4 mb-10">
        <input type="hidden" name="service" value="{{ $service->id }}">
        <input type="date" name="date" value="{{ $date }}" min="{{ today()->format('Y-m-d') }}"
               class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400">
        <button type="submit" class="bg-gray-900 text-white px-5 py-2 rounded-lg text-sm hover:bg-gray-700 transition">
            Voir les créneaux
        </button>
    </form>

    @if($creneaux->isEmpty())
        <p class="text-gray-400">Aucun créneau disponible pour cette date.</p>
    @else
        <h2 class="text-xl font-semibold mb-4">Créneaux disponibles</h2>
        <div class="flex flex-wrap gap-3">
            @foreach($creneaux as $creneau)
                <a href="/reserver/formulaire?service={{ $service->id }}&creneau={{ $creneau->id }}"
                   class="px-6 py-3 bg-white border-2 border-gray-900 rounded-lg font-bold text-gray-900 hover:bg-gray-900 hover:text-white transition">
                    {{ \Carbon\Carbon::parse($creneau->heure)->format('H\hi') }}
                </a>
            @endforeach
        </div>
    @endif
@endsection
