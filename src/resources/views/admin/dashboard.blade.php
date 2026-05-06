@extends('layouts.app')

@section('title', 'Dashboard Admin — Salon de Coiffure')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
        <h1>Tableau de bord</h1>
        <form method="GET" action="/admin" style="display: flex; gap: 12px; align-items: center;">
            <input type="date" name="date" value="{{ $date }}"
                   style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem;">
            <button type="submit" class="btn">Filtrer</button>
        </form>
    </div>

    @if($reservations->isEmpty())
        <p style="color: #888;">Aucune réservation pour cette date.</p>
    @else
        <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">
            <thead>
                <tr style="background: #1a1a1a; color: white;">
                    <th style="padding: 14px 16px; text-align: left;">Client</th>
                    <th style="padding: 14px 16px; text-align: left;">Service</th>
                    <th style="padding: 14px 16px; text-align: left;">Heure</th>
                    <th style="padding: 14px 16px; text-align: left;">Téléphone</th>
                    <th style="padding: 14px 16px; text-align: left;">Statut</th>
                    <th style="padding: 14px 16px; text-align: left;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 14px 16px;">
                            <div style="font-weight: bold;">{{ $reservation->client_nom }}</div>
                            <div style="color: #888; font-size: 0.85rem;">{{ $reservation->client_email }}</div>
                        </td>
                        <td style="padding: 14px 16px;">{{ $reservation->service->nom }}</td>
                        <td style="padding: 14px 16px;">{{ \Carbon\Carbon::parse($reservation->creneau->heure)->format('H\hi') }}</td>
                        <td style="padding: 14px 16px;">{{ $reservation->client_telephone }}</td>
                        <td style="padding: 14px 16px;">
                            @if($reservation->statut === 'confirmee')
                                <span style="background: #d4edda; color: #155724; padding: 4px 10px; border-radius: 20px; font-size: 0.85rem;">Confirmée</span>
                            @elseif($reservation->statut === 'annulee')
                                <span style="background: #f8d7da; color: #721c24; padding: 4px 10px; border-radius: 20px; font-size: 0.85rem;">Annulée</span>
                            @else
                                <span style="background: #fff3cd; color: #856404; padding: 4px 10px; border-radius: 20px; font-size: 0.85rem;">En attente</span>
                            @endif
                        </td>
                        <td style="padding: 14px 16px;">
                            <form method="POST" action="/admin/reservations/{{ $reservation->id }}/statut">
                                @csrf
                                @method('PATCH')
                                <select name="statut" onchange="this.form.submit()"
                                        style="padding: 6px; border: 1px solid #ccc; border-radius: 4px; font-size: 0.9rem;">
                                    <option value="en_attente" {{ $reservation->statut === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="confirmee" {{ $reservation->statut === 'confirmee' ? 'selected' : '' }}>Confirmée</option>
                                    <option value="annulee" {{ $reservation->statut === 'annulee' ? 'selected' : '' }}>Annulée</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
