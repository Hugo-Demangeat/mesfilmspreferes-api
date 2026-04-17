@extends('layouts.app')

@section('title','Recherche de films')

@section('content')
    <div class="page-header" style="display:flex;justify-content:space-between;gap:20px;align-items:center;flex-wrap:wrap;">
        <div>
            <h1 class="page-heading" style="color:#fff">Recherche de films</h1>
            <p class="section-note" style="color:#cbd5e1">Entrez un titre pour trouver votre prochain film préféré et consultez des détails enrichis.</p>
        </div>
    </div>

    <form id="searchForm" action="{{ route('films.searchFilm') }}" method="POST" class="search-toolbar">
        @csrf
        <div class="search-input-wrap">
            <input id="movie_search" class="search-input" type="text" name="titre" placeholder="Titre du film…" value="{{ $titre ?? '' }}" autocomplete="off">
            <div id="movie_suggestions" class="autocomplete-results"></div>
        </div>
        <button class="btn-primary" type="submit">Rechercher</button>
    </form>

    <div class="category-section">
        <div class="category-header">
            <div>
                <h2 class="category-title">Browsez par catégorie</h2>
                <p class="category-note">Films qui sortiront prochainement, populaires, récents et les mieux notés.</p>
            </div>
            <div class="category-actions">
                <button type="button" class="carousel-btn" data-action="prev" aria-label="Précédent">←</button>
                <button type="button" class="carousel-btn" data-action="next" aria-label="Suivant">→</button>
            </div>
        </div>

        <div class="category-pills" id="categoryList">
            <button type="button" class="category-pill active" data-category="upcoming">Sorties prochaines</button>
            <button type="button" class="category-pill" data-category="popular">Populaire</button>
            <button type="button" class="category-pill" data-category="now_playing">Sortie récemment</button>
            <button type="button" class="category-pill" data-category="top_rated">Les mieux notés</button>
        </div>

        <div class="category-results">
            <div class="category-results-header">
                <h3 id="categoryHeading">Films sortis prochainement</h3>
            </div>
            <div class="category-shelf" id="categoryShelf"></div>
        </div>
    </div>

    @isset($films)
        <div style="margin-top:18px">
            <h2 style="margin:0 0 10px">Résultats pour : <strong>"{{ $titre }}"</strong></h2>
            @if (count($films) === 0)
                <p class="empty-state">Aucun film trouvé.</p>
            @else
                <div class="films-grid">
                    @foreach ($films as $film)
                        <a class="film-card" href="{{ route('films.show', $film['id']) }}">
                            @if(!empty($film['poster_path']))
                                <img src="https://image.tmdb.org/t/p/w300{{ $film['poster_path'] }}" alt="{{ $film['title'] }}">
                            @else
                                <img src="https://via.placeholder.com/300x450?text=Pas+d'affiche" alt="Pas d'affiche">
                            @endif
                            <div class="meta">
                                <strong>{{ $film['title'] }}</strong>
                                <p>{{ $film['release_date'] ?? 'Date inconnue' }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    @endisset

    <script>
        (function() {
            const input = document.getElementById('movie_search');
            const sugg = document.getElementById('movie_suggestions');

            function debounce(fn, delay = 250) {
                let timeout;
                return (...args) => {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => fn(...args), delay);
                };
            }

            async function fetchMovies(query) {
                if (!query) {
                    sugg.innerHTML = '';
                    return;
                }

                try {
                    const response = await fetch('/api/movies/search?q=' + encodeURIComponent(query));
                    const data = await response.json();
                    sugg.innerHTML = '';
                    if (!data.length) {
                        sugg.innerHTML = '<div class="suggestion-item" style="cursor:default">Aucun résultat</div>';
                        return;
                    }

                    data.forEach(movie => {
                        const item = document.createElement('a');
                        item.className = 'suggestion-item';
                        item.href = '/film/' + movie.id;
                        item.innerHTML = `
                            <img src="${movie.poster_path ? 'https://image.tmdb.org/t/p/w92' + movie.poster_path : 'https://via.placeholder.com/48x72?text=?'}" alt="${movie.title}">
                            <div>
                                <strong>${movie.title}</strong>
                                <div style="font-size:0.9rem;color:#64748b;margin-top:4px">${movie.release_date || 'Date inconnue'}</div>
                            </div>
                        `;
                        sugg.appendChild(item);
                    });
                } catch (error) {
                    sugg.innerHTML = '';
                }
            }

            input.addEventListener('input', debounce((event) => {
                fetchMovies(event.target.value);
            }));

            document.addEventListener('click', function(event) {
                if (!sugg.contains(event.target) && event.target !== input) {
                    sugg.innerHTML = '';
                }
            });

            const categoryShelf = document.getElementById('categoryShelf');
            const categoryHeading = document.getElementById('categoryHeading');
            const categoryButtons = document.querySelectorAll('.category-pill');
            const categoryList = document.getElementById('categoryList');

            const categories = {
                upcoming: 'Films sortis prochainement',
                popular: 'Films populaires',
                now_playing: 'Sortie récemment',
                top_rated: 'Les mieux notés'
            };

            function renderCategoryMovies(movies) {
                categoryShelf.innerHTML = '';
                if (!movies.length) {
                    categoryShelf.innerHTML = '<div class="empty-state">Aucun film trouvé pour cette catégorie.</div>';
                    return;
                }

                movies.forEach(movie => {
                    const card = document.createElement('a');
                    card.className = 'category-card';
                    card.href = '/film/' + movie.id;
                    card.innerHTML = `
                        ${movie.poster_path ? `<img src="https://image.tmdb.org/t/p/w300${movie.poster_path}" alt="${movie.title}">` : `<div class="poster-placeholder">Pas d'affiche</div>`}
                        <div class="category-card-meta">
                            <strong>${movie.title}</strong>
                            <span>${movie.release_date || 'Date inconnue'}</span>
                        </div>
                    `;
                    categoryShelf.appendChild(card);
                });
            }

            async function loadCategory(type) {
                categoryHeading.textContent = categories[type] || categories.upcoming;
                categoryButtons.forEach(btn => btn.classList.toggle('active', btn.dataset.category === type));

                try {
                    const response = await fetch(`/api/movies/category?type=${type}`);
                    const data = await response.json();
                    renderCategoryMovies(data);
                } catch (error) {
                    categoryShelf.innerHTML = '<div class="empty-state">Impossible de charger les films pour le moment.</div>';
                }
            }

            categoryButtons.forEach(button => {
                button.addEventListener('click', () => loadCategory(button.dataset.category));
            });

            document.querySelectorAll('.carousel-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const amount = button.dataset.action === 'prev' ? -260 : 260;
                    categoryShelf.scrollBy({ left: amount, behavior: 'smooth' });
                });
            });

            loadCategory('upcoming');
        })();
    </script>
@endsection