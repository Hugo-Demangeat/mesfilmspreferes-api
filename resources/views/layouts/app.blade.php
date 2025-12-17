<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'Mes Films Préférés')</title>
    @include('partials.theme')
</head>
<body>
    <header style="padding:18px 24px;background:linear-gradient(90deg,#0b1226,#112240);color:#fff;">
        <div style="max-width:1200px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;gap:12px">
            <a href="{{ route('accueil') }}" style="color:#fff;text-decoration:none;font-weight:800;font-size:20px">🎬 Mes Films Préférés</a>
            @auth
                @include('partials.navbar')
            @else
                <div>
                    <a class="btn-primary" href="{{ route('connexion') }}">Se connecter</a>
                    <a class="btn-secondary" href="{{ route('creerCompte') }}">Créer un compte</a>
                </div>
            @endauth
        </div>
    </header>

    <main style="max-width:1200px;margin:28px auto;padding:0 20px">
        @yield('content')
    </main>

    <!-- footer intentionally left blank per user preference -->
</body>
</html>
