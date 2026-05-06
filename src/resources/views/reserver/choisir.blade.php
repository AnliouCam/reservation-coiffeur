@extends('layouts.app')

@section('title', 'Choisir un service — Salon de Coiffure')

@section('content')
    <h1 style="margin-bottom: 8px;">Choisir un service</h1>
    <p style="color: #666; margin-bottom: 32px;">Sélectionnez le service que vous souhaitez réserver.</p>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 20px;">
        @foreach($services as $service)
            <a href="/reserver/creneaux?service={{ $service->id }}" style="text-decoration: none; color: inherit;">
                <div style="background: white; border-radius: 8px; padding: 24px; box-shadow: 0 2px 6px rgba(0,0,0,0.08); cursor: pointer;">
                    <h3 style="margin-bottom: 8px;">{{ $service->nom }}</h3>
                    <p style="color: #888; font-size: 0.9rem;">Durée : {{ $service->duree }} min</p>
                    <p style="font-size: 1.3rem; font-weight: bold; margin-top: 12px;">{{ number_format($service->prix, 2) }} €</p>
                </div>
            </a>
        @endforeach
    </div>
@endsection
