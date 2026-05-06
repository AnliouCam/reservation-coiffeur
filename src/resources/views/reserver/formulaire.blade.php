@extends('layouts.app')

@section('title', 'Formulaire de réservation — Salon de Coiffure')

@section('content')
    <h1 style="margin-bottom: 4px;">Vos informations</h1>
    <p style="color: #666; margin-bottom: 32px;">
        {{ $service->nom }} — {{ \Carbon\Carbon::parse($creneau->date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($creneau->heure)->format('H\hi') }}
    </p>

    @if($errors->any())
        <div style="background: #fee; border: 1px solid #fcc; padding: 16px; border-radius: 6px; margin-bottom: 24px;">
            @foreach($errors->all() as $error)
                <p style="color: #c00;">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/reserver/formulaire" style="max-width: 480px;">
        @csrf
        <input type="hidden" name="service_id" value="{{ $service->id }}">
        <input type="hidden" name="creneau_id" value="{{ $creneau->id }}">

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 6px;">Nom complet</label>
            <input type="text" name="client_nom" value="{{ old('client_nom') }}" required
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 6px;">Email</label>
            <input type="email" name="client_email" value="{{ old('client_email') }}" required
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem;">
        </div>

        <div style="margin-bottom: 28px;">
            <label style="display: block; font-weight: bold; margin-bottom: 6px;">Téléphone</label>
            <input type="text" name="client_telephone" value="{{ old('client_telephone') }}" required
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem;">
        </div>

        <button type="submit" class="btn" style="width: 100%; text-align: center;">
            Confirmer la réservation
        </button>
    </form>
@endsection
