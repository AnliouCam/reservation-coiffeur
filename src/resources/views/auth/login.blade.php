@extends('layouts.app')

@section('title', 'Connexion Admin — Salon de Coiffure')

@section('content')
    <div class="max-w-md mx-auto">
        <h1 class="text-3xl font-bold mb-2">Connexion Admin</h1>
        <p class="text-gray-500 mb-8">Accès réservé aux administrateurs.</p>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 mb-6">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/login" class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 space-y-5">
            @csrf
            <div>
                <label class="block font-semibold mb-1 text-sm">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400">
            </div>
            <div>
                <label class="block font-semibold mb-1 text-sm">Mot de passe</label>
                <input type="password" name="password" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400">
            </div>
            <button type="submit" class="w-full bg-gray-900 text-white py-3 rounded-lg font-semibold hover:bg-gray-700 transition">
                Se connecter
            </button>
        </form>
    </div>
@endsection
