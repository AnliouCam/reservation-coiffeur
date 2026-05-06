@extends('layouts.app')

@section('title', 'Formulaire de réservation — Salon de Coiffure')

@section('content')
    <div class="max-w-lg mx-auto">
        <h1 class="text-3xl font-bold mb-1">Vos informations</h1>
        <p class="text-gray-500 mb-8">
            {{ $service->nom }} — {{ \Carbon\Carbon::parse($creneau->date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($creneau->heure)->format('H\hi') }}
        </p>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 mb-6">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/reserver/formulaire" class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 space-y-5">
            @csrf
            <input type="hidden" name="service_id" value="{{ $service->id }}">
            <input type="hidden" name="creneau_id" value="{{ $creneau->id }}">

            <div>
                <label class="block font-semibold mb-1 text-sm">Nom complet</label>
                <input type="text" name="client_nom" value="{{ old('client_nom') }}" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400">
            </div>

            <div>
                <label class="block font-semibold mb-1 text-sm">Email</label>
                <input type="email" name="client_email" value="{{ old('client_email') }}" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400">
            </div>

            <div>
                <label class="block font-semibold mb-1 text-sm">Téléphone</label>
                <input type="text" name="client_telephone" value="{{ old('client_telephone') }}" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400">
            </div>

            <button type="submit" class="w-full bg-gray-900 text-white py-3 rounded-lg font-semibold hover:bg-gray-700 transition">
                Confirmer la réservation
            </button>
        </form>
    </div>
@endsection
