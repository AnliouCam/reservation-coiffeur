@extends('layouts.app')

@section('title', 'Connexion Admin — Salon de Coiffure')

@section('content')
    <div style="max-width: 400px; margin: 0 auto;">
        <h1 style="margin-bottom: 8px;">Connexion Admin</h1>
        <p style="color: #666; margin-bottom: 32px;">Accès réservé aux administrateurs.</p>

        @if($errors->any())
            <div style="background: #fee; border: 1px solid #fcc; padding: 16px; border-radius: 6px; margin-bottom: 24px;">
                @foreach($errors->all() as $error)
                    <p style="color: #c00;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/login" style="background: white; padding: 32px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">
            @csrf

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold; margin-bottom: 6px;">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem;">
            </div>

            <div style="margin-bottom: 28px;">
                <label style="display: block; font-weight: bold; margin-bottom: 6px;">Mot de passe</label>
                <input type="password" name="password" required
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem;">
            </div>

            <button type="submit" class="btn" style="width: 100%; text-align: center;">
                Se connecter
            </button>
        </form>
    </div>
@endsection
