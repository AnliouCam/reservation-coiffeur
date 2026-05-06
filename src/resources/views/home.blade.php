@extends('layouts.app')

@section('title', 'Accueil — Salon de Coiffure')

@section('content')
    <div style="text-align:center; margin-bottom: 48px;">
        <h1 style="font-size: 2.5rem; margin-bottom: 12px;">Bienvenue au Salon</h1>
        <p style="color: #666; font-size: 1.1rem;">Prenez soin de vous, réservez en ligne en quelques clics.</p>
        <a href="/reserver" class="btn" style="margin-top: 24px;">Réserver maintenant</a>
    </div>

    <h2 style="margin-bottom: 24px;">Nos services</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 20px;">
        @foreach($services as $service)
            <div style="background: white; border-radius: 8px; padding: 24px; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">
                <h3 style="margin-bottom: 8px;">{{ $service->nom }}</h3>
                <p style="color: #888; font-size: 0.9rem;">Durée : {{ $service->duree }} min</p>
                <p style="font-size: 1.3rem; font-weight: bold; margin-top: 12px;">{{ number_format($service->prix, 2) }} €</p>
            </div>
        @endforeach
    </div>
@endsection
