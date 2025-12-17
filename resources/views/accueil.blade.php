@extends('layouts.app')

@section('title','Accueil - Mes Films Préférés')

@section('content')
    <div class="container-card" style="display:flex;gap:24px;align-items:center;">
        <div style="flex:1">
            <h1 style="margin:0;font-size:34px">Bienvenue sur Mes Films Préférés</h1>
            <p style="color:var(--muted);margin-top:10px">Découvrez, partagez et gérez vos films préférés. Utilisez la recherche pour trouver des films, ajoutez-les à vos favoris et partage-les avec vos amis.</p>
            <div style="margin-top:18px;display:flex;gap:10px">
                <a href="{{ route('films.search') }}" class="btn-primary">Recherche de films</a>
                @auth
                    <a href="{{ route('profil.index') }}" class="btn-secondary">Mon profil</a>
                @endauth
            </div>
        </div>
        <div style="width:320px;flex:0 0 320px;text-align:center">
            <img src="/avatars/placeholder-poster.png" alt="poster" style="width:100%;border-radius:10px;box-shadow:0 8px 30px rgba(2,6,23,0.2)">
        </div>
    </div>
@endsection