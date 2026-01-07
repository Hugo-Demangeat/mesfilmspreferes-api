<!-- filepath: resources/views/partages/index.blade.php -->
@extends('layouts.app')

@section('title','Mes Partages - Mes Films Préférés')

@section('content')
    <div class="container-card">
        <h1 style="margin:0 0 14px">📤 Mes Partages</h1>

        @if(session('success'))
            <div style="background:#4caf50;color:#fff;padding:10px;border-radius:8px;margin-bottom:12px;text-align:center">{{ session('success') }}</div>
        @endif

        <a href="/rechercher" class="btn-secondary" style="display:inline-block;margin-bottom:14px">← Retour à la recherche</a>

        <h2 style="margin-top:6px">Partager un film avec un ami</h2>
        <form action="{{ route('partages.add') }}" method="POST">
            @csrf

            <label for="friend_search">Rechercher un ami</label>
            <input type="text" id="friend_search" placeholder="Tapez le nom ou pseudo..." style="width:100%;padding:10px;border-radius:8px;border:1px solid #eee;margin-top:6px">
            <input type="hidden" name="ami_id" id="ami_id">
            <div id="friend_suggestions" style="max-width:480px;margin:8px 0"></div>

            <label for="movie_search" style="display:block;margin-top:8px">Rechercher un film</label>
            <input type="text" id="movie_search" placeholder="Titre du film..." style="width:100%;padding:10px;border-radius:8px;border:1px solid #eee;margin-top:6px">
            <input type="hidden" name="film_id" id="film_id">
            <input type="hidden" name="film_title" id="film_title">
            <input type="hidden" name="film_poster_path" id="film_poster_path">
            <div id="movie_suggestions" style="max-width:480px;margin:8px 0"></div>
            <div id="selected_movie" style="margin:8px 0"></div>

            <textarea name="message" placeholder="Message (optionnel)" rows="2" style="width:100%;padding:10px;border-radius:8px;border:1px solid #eee;margin-top:6px"></textarea>
            <div style="margin-top:8px"><button class="btn-primary" type="submit">Partager</button></div>
        </form>

        <style>
            .suggestion-item{display:flex;gap:8px;align-items:center;padding:8px;border:1px solid #eee;border-radius:8px;margin-bottom:8px;cursor:pointer}
            .suggestion-item img{width:48px;height:72px;object-fit:cover;border-radius:4px}
            .suggestion-item .meta{font-size:14px}
            .suggestion-item:hover{background:#f5f7ff}
        </style>

        <script>
            const friendSearch = document.getElementById('friend_search');
            const friendSuggestions = document.getElementById('friend_suggestions');
            const amiIdInput = document.getElementById('ami_id');

            const movieSearch = document.getElementById('movie_search');
            const movieSuggestions = document.getElementById('movie_suggestions');
            const filmIdInput = document.getElementById('film_id');
            const filmTitleInput = document.getElementById('film_title');
            const filmPosterInput = document.getElementById('film_poster_path');
            const selectedMovie = document.getElementById('selected_movie');

            function debounce(fn, delay=300){let t;return (...args)=>{clearTimeout(t);t=setTimeout(()=>fn(...args),delay)}}

            async function fetchUsers(q){
                // allow empty q: server will return user's friends when calling the friends endpoint
                const res = await fetch('/api/friends/search?q='+encodeURIComponent(q));
                const data = await res.json();
                friendSuggestions.innerHTML='';
                data.forEach(u=>{
                    const el = document.createElement('div');
                    el.className='suggestion-item';
                    el.innerHTML = `<div class="meta"><strong>${u.firstname} ${u.lastname}</strong><div style="font-size:12px;color:#666">@${u.username}</div></div>`;
                    el.addEventListener('click', ()=>{
                        friendSearch.value = u.firstname + ' ' + u.lastname + ' (@'+u.username+')';
                        amiIdInput.value = u.id;
                        friendSuggestions.innerHTML='';
                    });
                    friendSuggestions.appendChild(el);
                })
            }

            async function fetchMovies(q){
                if(!q) { movieSuggestions.innerHTML=''; return }
                const res = await fetch('/api/movies/search?q='+encodeURIComponent(q));
                const data = await res.json();
                movieSuggestions.innerHTML='';
                data.forEach(m=>{
                    const el = document.createElement('div');
                    el.className='suggestion-item';
                    const img = m.poster_path ? 'https://image.tmdb.org/t/p/w92'+m.poster_path : 'https://via.placeholder.com/48x72?text=?';
                    el.innerHTML = `<img src="${img}" alt=""><div class="meta"><strong>${m.title}</strong><div style="font-size:12px;color:#666">${m.release_date || ''}</div></div>`;
                    el.addEventListener('click', ()=>{
                        movieSearch.value = m.title;
                        filmIdInput.value = m.id;
                        filmTitleInput.value = m.title;
                        filmPosterInput.value = m.poster_path ? 'https://image.tmdb.org/t/p/w500'+m.poster_path : '';
                        movieSuggestions.innerHTML='';
                        selectedMovie.innerHTML = `<div style="display:flex;gap:12px;align-items:center"><img src="${m.poster_path?('https://image.tmdb.org/t/p/w154'+m.poster_path):'https://via.placeholder.com/92x138?text=?'}" style="width:92px;height:138px;object-fit:cover;border-radius:6px"><div><strong>${m.title}</strong><div style="color:#666">${m.release_date || ''}</div></div></div>`;
                    });
                    movieSuggestions.appendChild(el);
                })
            }

            friendSearch.addEventListener('input', debounce(e=>fetchUsers(e.target.value)));
            friendSearch.addEventListener('focus', ()=>fetchUsers(friendSearch.value));
            movieSearch.addEventListener('input', debounce(e=>fetchMovies(e.target.value)));
        </script>

        <h2 style="margin-top:18px">Partages envoyés</h2>
        @if(isset($partages_outgoing) && $partages_outgoing->isEmpty())
            <p>Vous n'avez encore partagé aucun film.</p>
        @else
            <div class="partages-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:18px;margin-top:12px">
                @foreach($partages_outgoing as $partage)
                    <div class="film-card" style="padding:12px">
                        @if($partage->film_poster_path)
                            <img src="{{ $partage->film_poster_path }}" alt="{{ $partage->film_title }}">
                        @endif
                        <div class="meta">
                            <h3 style="margin:8px 0">{{ $partage->film_title }}</h3>
                            <p style="color:var(--muted)">À : {{ $partage->friend->username ?? 'Utilisateur supprimé' }}</p>
                            @if($partage->message)
                                <p style="color:var(--muted);font-size:14px">Message : {{ $partage->message }}</p>
                            @endif
                            <form action="{{ route('partages.destroy', $partage->id) }}" method="POST" style="margin-top:10px">
                                @csrf
                                <button class="btn-primary" type="submit">Supprimer</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <h2 style="margin-top:26px">Partages reçus</h2>
        @if(isset($partages_incoming) && $partages_incoming->isEmpty())
            <p>Vous n'avez reçu aucun partage.</p>
        @else
            <div class="partages-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:18px;margin-top:12px">
                @foreach($partages_incoming as $partage)
                    <div class="film-card" style="padding:12px">
                        @if($partage->film_poster_path)
                            <img src="{{ $partage->film_poster_path }}" alt="{{ $partage->film_title }}">
                        @endif
                        <div class="meta">
                            <h3 style="margin:8px 0">{{ $partage->film_title }}</h3>
                            <p style="color:var(--muted)">De : {{ $partage->user->username ?? 'Utilisateur supprimé' }}</p>
                            @if($partage->message)
                                <p style="color:var(--muted);font-size:14px">Message : {{ $partage->message }}</p>
                            @endif
                            <form action="{{ route('partages.destroy', $partage->id) }}" method="POST" style="margin-top:10px">
                                @csrf
                                <button class="btn-primary" type="submit">Supprimer</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
