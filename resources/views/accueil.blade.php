@extends('layouts.app')

@section('title','Accueil - Mes Films Préférés')

@section('content')
    <div class="container-card" style="display:flex;gap:24px;align-items:flex-start;flex-wrap:wrap;">
        <div style="flex:1;min-width:280px;">
            <h1 style="margin:0;font-size:34px">Bienvenue sur Mes Films Préférés</h1>
            <p style="color:#475569;margin-top:10px">Découvrez les sorties à venir grâce à l'API et préparez-vous à vos prochaines séances. Recherchez des films, ajoutez-les à vos favoris et partage-les avec vos amis.</p>
            <div style="margin-top:18px;display:grid;gap:12px;max-width:280px;">
                <a href="{{ route('films.search') }}" class="btn-primary">Recherche de films</a>
                @auth
                    <a href="{{ route('profil.index') }}" class="btn-secondary">Mon profil</a>
                @endauth
            </div>
        </div>

    </div>

    <section class="home-upcoming-section">
        <div class="upcoming-slider-card">
            <div class="upcoming-slider-header">
                <div>
                    <span class="pill">Prochainement</span>
                    <strong>Films à découvrir bientôt</strong>
                </div>
                <div class="slider-controls">
                    <button type="button" class="carousel-btn" data-action="prev" aria-label="Précédent">←</button>
                    <button type="button" class="carousel-btn" data-action="next" aria-label="Suivant">→</button>
                </div>
            </div>

            @if(!empty($upcomingMovies))
                <div class="upcoming-slider-track" id="homeUpcomingTrack">
                    @foreach($upcomingMovies as $film)
                        <a href="{{ route('films.show', $film['id']) }}" class="upcoming-slide">
                            @if(!empty($film['poster_path']))
                                <img src="https://image.tmdb.org/t/p/w300{{ $film['poster_path'] }}" alt="{{ $film['title'] }}">
                            @else
                                <div class="poster-placeholder">Pas d'affiche</div>
                            @endif
                            <div class="upcoming-slide-meta">
                                <strong>{{ $film['title'] }}</strong>
                                <span>{{ $film['release_date'] ?? 'Date inconnue' }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="upcoming-empty" style="padding:24px;color:#64748b;">
                    <span>Aucune sortie à venir disponible pour le moment.</span>
                </div>
            @endif
        </div>
    </section>

    <script>
        (function() {
            const track = document.getElementById('homeUpcomingTrack');
            if (!track) return;
            document.querySelectorAll('.upcoming-slider-card .carousel-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const amount = button.dataset.action === 'prev' ? -320 : 320;
                    track.scrollBy({ left: amount, behavior: 'smooth' });
                });
            });
        })();
    </script>
@endsection