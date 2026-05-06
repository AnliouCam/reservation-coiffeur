@extends('layouts.app')

@section('title', 'Choisir un service — Salon de Coiffure')

@section('content')
    <h1 class="text-3xl font-bold mb-2">Choisir un service</h1>
    <p class="text-gray-500 mb-8">Sélectionnez le service que vous souhaitez réserver.</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($services as $service)
            <a href="/reserver/creneaux?service={{ $service->id }}" class="block bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md hover:border-gray-300 transition">
                <h3 class="text-lg font-semibold mb-2">{{ $service->nom }}</h3>
                <p class="text-gray-400 text-sm">Durée : {{ $service->duree }} min</p>
                <p class="text-2xl font-bold mt-4">{{ number_format($service->prix, 2) }} €</p>
            </a>
        @endforeach
    </div>
@endsection
