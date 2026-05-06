@extends('layouts.app')

@section('title', 'Réservation confirmée — Salon de Coiffure')

@section('content')
    <div style="max-width: 520px; margin: 0 auto; text-align: center;">
        <div style="font-size: 3rem; margin-bottom: 16px;">✓</div>
        <h1 style="margin-bottom: 8px;">Réservation enregistrée !</h1>
        <p style="color: #666; margin-bottom: 40px;">Merci {{ $reservation->client_nom }}, votre demande a bien été prise en compte.</p>

        <div style="background: white; border-radius: 8px; padding: 32px; box-shadow: 0 2px 6px rgba(0,0,0,0.08); text-align: left;">
            <h2 style="margin-bottom: 20px; font-size: 1.1rem; color: #888; text-transform: uppercase; letter-spacing: 1px;">Récapitulatif</h2>

            <table style="width: 100%; border-collapse: collapse;">
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px 0; color: #888;">Service</td>
                    <td style="padding: 12px 0; font-weight: bold;">{{ $reservation->service->nom }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px 0; color: #888;">Date</td>
                    <td style="padding: 12px 0; font-weight: bold;">{{ \Carbon\Carbon::parse($reservation->creneau->date)->format('d/m/Y') }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px 0; color: #888;">Heure</td>
                    <td style="padding: 12px 0; font-weight: bold;">{{ \Carbon\Carbon::parse($reservation->creneau->heure)->format('H\hi') }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px 0; color: #888;">Prix</td>
                    <td style="padding: 12px 0; font-weight: bold;">{{ number_format($reservation->service->prix, 2) }} €</td>
                </tr>
                <tr>
                    <td style="padding: 12px 0; color: #888;">Statut</td>
                    <td style="padding: 12px 0;">
                        <span style="background: #fff3cd; color: #856404; padding: 4px 10px; border-radius: 20px; font-size: 0.85rem;">
                            En attente de confirmation
                        </span>
                    </td>
                </tr>
            </table>
        </div>

        <a href="/" class="btn" style="margin-top: 32px;">Retour à l'accueil</a>
    </div>
@endsection
