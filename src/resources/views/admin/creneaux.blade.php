@extends('layouts.app')

@section('title', 'Gestion des créneaux — Admin')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
        <h1>Gestion des créneaux</h1>
        <a href="/admin" style="color: #666; text-decoration: none;">← Retour au dashboard</a>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 32px;">

        {{-- Formulaire ajout créneau --}}
        <div style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">
            <h2 style="margin-bottom: 20px;">Ajouter des créneaux</h2>
            <form method="POST" action="/admin/creneaux">
                @csrf
                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 6px;">Date</label>
                    <input type="date" name="date" value="{{ $date }}" required
                           style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem;">
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 6px;">Heure</label>
                    <select name="heure" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem;">
                        @for($h = 9; $h <= 17; $h++)
                            <option value="{{ str_pad($h, 2, '0', STR_PAD_LEFT) }}:00:00">{{ str_pad($h, 2, '0', STR_PAD_LEFT) }}h00</option>
                            <option value="{{ str_pad($h, 2, '0', STR_PAD_LEFT) }}:30:00">{{ str_pad($h, 2, '0', STR_PAD_LEFT) }}h30</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="btn" style="width: 100%; text-align: center;">Ajouter</button>
            </form>
        </div>

        {{-- Liste des créneaux du jour --}}
        <div>
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                <h2>Créneaux du</h2>
                <form method="GET" action="/admin/creneaux" style="display: flex; gap: 8px;">
                    <input type="date" name="date" value="{{ $date }}"
                           style="padding: 6px 10px; border: 1px solid #ccc; border-radius: 6px;">
                    <button type="submit" class="btn" style="padding: 6px 14px;">OK</button>
                </form>
            </div>

            @if($creneaux->isEmpty())
                <p style="color: #888;">Aucun créneau pour cette date.</p>
            @else
                <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                    @foreach($creneaux as $creneau)
                        <form method="POST" action="/admin/creneaux/{{ $creneau->id }}/toggle">
                            @csrf
                            @method('PATCH')
                            <button type="submit" style="
                                padding: 10px 18px;
                                border-radius: 6px;
                                border: 2px solid {{ $creneau->disponible ? '#1a1a1a' : '#ccc' }};
                                background: {{ $creneau->disponible ? '#1a1a1a' : '#f5f5f5' }};
                                color: {{ $creneau->disponible ? 'white' : '#999' }};
                                cursor: pointer;
                                font-size: 1rem;
                            ">
                                {{ \Carbon\Carbon::parse($creneau->heure)->format('H\hi') }}
                                @if(!$creneau->disponible) 🔒 @endif
                            </button>
                        </form>
                    @endforeach
                </div>
                <p style="color: #888; font-size: 0.85rem; margin-top: 12px;">Cliquer sur un créneau pour le bloquer/débloquer.</p>
            @endif
        </div>
    </div>

    {{-- Lien dans le dashboard --}}
    <div style="margin-top: 40px;">
        <a href="/admin/creneaux" class="btn">Gérer les créneaux</a>
    </div>
@endsection
