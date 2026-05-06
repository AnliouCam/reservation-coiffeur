@extends('layouts.app')

@section('title', 'Choisir un créneau — Salon de Coiffure')

@section('content')
    <h1 style="margin-bottom: 4px;">Choisir un créneau</h1>
    <p style="color: #666; margin-bottom: 32px;">Service : <strong>{{ $service->nom }}</strong> — {{ $service->duree }} min — {{ number_format($service->prix, 2) }} €</p>

    <form method="GET" action="/reserver/creneaux" style="margin-bottom: 32px;">
        <input type="hidden" name="service" value="{{ $service->id }}">
        <label style="font-weight: bold; display: block; margin-bottom: 8px;">Choisir une date :</label>
        <input type="date" name="date" value="{{ $date }}" min="{{ today()->format('Y-m-d') }}"
               style="padding: 10px; font-size: 1rem; border: 1px solid #ccc; border-radius: 6px; margin-right: 12px;">
        <button type="submit" style="padding: 10px 20px; background: #1a1a1a; color: white; border: none; border-radius: 6px; font-size: 1rem; cursor: pointer;">
            Voir les créneaux
        </button>
    </form>

    @if($creneaux->isEmpty())
        <p style="color: #888;">Aucun créneau disponible pour cette date.</p>
    @else
        <h2 style="margin-bottom: 16px;">Créneaux disponibles</h2>
        <div style="display: flex; flex-wrap: wrap; gap: 12px;">
            @foreach($creneaux as $creneau)
                <a href="/reserver/formulaire?service={{ $service->id }}&creneau={{ $creneau->id }}"
                   style="display: block; padding: 16px 24px; background: white; border: 2px solid #1a1a1a; border-radius: 8px; text-decoration: none; color: #1a1a1a; font-size: 1.1rem; font-weight: bold;">
                    {{ \Carbon\Carbon::parse($creneau->heure)->format('H\hi') }}
                </a>
            @endforeach
        </div>
    @endif
@endsection
