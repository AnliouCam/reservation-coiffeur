@extends('layouts.app')

@section('title', 'Gestion des créneaux — Admin')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Gestion des créneaux</h1>
        <a href="/admin" class="text-sm text-gray-500 hover:text-gray-900 transition">← Retour au dashboard</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            <h2 class="text-lg font-bold mb-6">Ajouter un créneau</h2>
            <form method="POST" action="/admin/creneaux" class="space-y-4">
                @csrf
                <div>
                    <label class="block font-semibold mb-1 text-sm">Date</label>
                    <input type="date" name="date" value="{{ $date }}" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400">
                </div>
                <div>
                    <label class="block font-semibold mb-1 text-sm">Heure</label>
                    <select name="heure" required class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400">
                        @for($h = 9; $h <= 17; $h++)
                            <option value="{{ str_pad($h, 2, '0', STR_PAD_LEFT) }}:00:00">{{ str_pad($h, 2, '0', STR_PAD_LEFT) }}h00</option>
                            <option value="{{ str_pad($h, 2, '0', STR_PAD_LEFT) }}:30:00">{{ str_pad($h, 2, '0', STR_PAD_LEFT) }}h30</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="w-full bg-gray-900 text-white py-2 rounded-lg text-sm font-semibold hover:bg-gray-700 transition">
                    Ajouter
                </button>
            </form>
        </div>

        <div>
            <div class="flex items-center gap-4 mb-6">
                <h2 class="text-lg font-bold">Créneaux du</h2>
                <form method="GET" action="/admin/creneaux" class="flex gap-2">
                    <input type="date" name="date" value="{{ $date }}"
                           class="border border-gray-300 rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400">
                    <button type="submit" class="bg-gray-900 text-white px-3 py-1 rounded-lg text-sm hover:bg-gray-700 transition">OK</button>
                </form>
            </div>

            @if($creneaux->isEmpty())
                <p class="text-gray-400 text-sm">Aucun créneau pour cette date.</p>
            @else
                <div class="flex flex-wrap gap-3">
                    @foreach($creneaux as $creneau)
                        <form method="POST" action="/admin/creneaux/{{ $creneau->id }}/toggle">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-5 py-2 rounded-lg font-semibold text-sm border-2 transition
                                {{ $creneau->disponible
                                    ? 'bg-gray-900 text-white border-gray-900 hover:bg-gray-700'
                                    : 'bg-gray-100 text-gray-400 border-gray-200 hover:bg-gray-200' }}">
                                {{ \Carbon\Carbon::parse($creneau->heure)->format('H\hi') }}
                                @if(!$creneau->disponible) 🔒 @endif
                            </button>
                        </form>
                    @endforeach
                </div>
                <p class="text-gray-400 text-xs mt-4">Cliquer sur un créneau pour le bloquer / débloquer.</p>
            @endif
        </div>
    </div>
@endsection
