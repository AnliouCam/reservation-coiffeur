<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Salon de Coiffure')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f9f9f9; color: #333; }
        header { background: #1a1a1a; color: white; padding: 16px 32px; display: flex; justify-content: space-between; align-items: center; }
        header a { color: white; text-decoration: none; font-size: 1.4rem; font-weight: bold; }
        nav a { color: #ccc; text-decoration: none; margin-left: 24px; }
        nav a:hover { color: white; }
        main { max-width: 960px; margin: 40px auto; padding: 0 24px; }
        .btn { display: inline-block; background: #1a1a1a; color: white; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-size: 1rem; }
        .btn:hover { background: #333; }
    </style>
</head>
<body>
    <header>
        <a href="/">Salon de Coiffure</a>
        <nav>
            <a href="/">Accueil</a>
            <a href="/reserver">Réserver</a>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
