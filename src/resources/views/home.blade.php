@extends('layouts.app')

@section('title', 'Accueil — Salon de Coiffure')

@section('content')
    <div class="text-center mb-16">
        <h1 class="text-5xl font-bold mb-4">Bienvenue au Salon</h1>
        <p class="text-gray-500 text-lg mb-8">Prenez soin de vous, réservez en ligne en quelques clics.</p>
        <a href="/reserver" class="bg-gray-900 text-white px-8 py-3 rounded-lg text-lg hover:bg-gray-700 transition">
            Réserver maintenant
        </a>
    </div>

    <h2 class="text-2xl font-bold mb-6">Nos services</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($services as $service)
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <h3 class="text-lg font-semibold mb-2">{{ $service->nom }}</h3>
                <p class="text-gray-400 text-sm">Durée : {{ $service->duree }} min</p>
                <p class="text-2xl font-bold mt-4">{{ number_format($service->prix, 2) }} €</p>
            </div>
        @endforeach
    </div>
@endsection
