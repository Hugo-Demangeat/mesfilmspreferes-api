<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'Mes Films Préférés')</title>
    @include('partials.theme')
</head>
<body class="app-body">
    <header class="site-header">
        <div class="header-inner">
            <a href="{{ route('accueil') }}" class="brand">
                <img src="{{ asset('images/logo-mesfilmspreferes.png') }}" alt="Logo Mes Films Préférés" class="brand-logo">
                <span class="brand-text">
                    <span class="brand-title">Mes Films Préférés</span>
                    <span class="brand-subtitle">Ciné, favoris, partage</span>
                </span>
            </a>
            @auth
                @include('partials.navbar')
            @else
                <div class="header-actions">
                    <a class="btn-primary" href="{{ route('connexion') }}">Se connecter</a>
                    <a class="btn-secondary" href="{{ route('creerCompte') }}">Créer un compte</a>
                </div>
            @endauth
        </div>
    </header>

    <main class="main-content">
        @yield('content')
    </main>

    <!-- footer intentionally left blank per user preference -->
</body>
</html>
