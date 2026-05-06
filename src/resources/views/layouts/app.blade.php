<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Salon de Coiffure')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">

    <header class="bg-gray-900 text-white px-8 py-4 flex justify-between items-center shadow">
        <a href="/" class="text-xl font-bold tracking-wide">Salon de Coiffure</a>
        <nav class="flex items-center gap-6 text-sm">
            <a href="/" class="text-gray-300 hover:text-white transition">Accueil</a>
            <a href="/reserver" class="text-gray-300 hover:text-white transition">Réserver</a>
            @auth
                <a href="/admin" class="text-gray-300 hover:text-white transition">Admin</a>
                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-300 hover:text-white transition cursor-pointer bg-transparent border-none text-sm">
                        Déconnexion
                    </button>
                </form>
            @endauth
        </nav>
    </header>

    <main class="max-w-5xl mx-auto px-6 py-10">
        @yield('content')
    </main>

</body>
</html>
