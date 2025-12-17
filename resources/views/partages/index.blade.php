<!-- filepath: resources/views/partages/index.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Partages - Mes Films Préférés</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh; padding: 20px;
        }
        .container {
            max-width: 900px; margin: 50px auto; background: white;
            border-radius: 10px; padding: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }
        h1 { text-align: center; margin-bottom: 30px; }
        .success-message { background: #4caf50; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align:center; }
        .partages-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; }
        .partage-card { border: 1px solid #ddd; border-radius: 5px; padding: 10px; text-align: center; background: #f9f9f9; }
        .partage-card img { max-width: 100%; border-radius: 5px; margin-bottom: 10px; }
        button { padding: 5px 10px; border-radius: 5px; border: none; background: #667eea; color: white; cursor: pointer; margin-top: 5px; }
        button:hover { background: #5568d3; }
        input, textarea { width: 80%; padding: 5px; margin-bottom: 5px; }
        a { text-decoration: none; color: #667eea; font-weight: bold; display: inline-block; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="container">
        @auth
            @include('partials.navbar')
        @endauth
        <h1>📤 Mes Partages</h1>

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <a href="/rechercher">← Retour à la recherche</a>

        <h2>Partager un film avec un ami</h2>
        <form action="{{ route('partages.add') }}" method="POST">
            @csrf

            <label for="friend_search">Rechercher un ami</label><br>
            <input type="text" id="friend_search" placeholder="Tapez le nom ou pseudo...">
            <input type="hidden" name="ami_id" id="ami_id">
            <div id="friend_suggestions" style="max-width:480px;margin:8px 0"></div>

            <label for="movie_search">Rechercher un film</label><br>
            <input type="text" id="movie_search" placeholder="Titre du film...">
            <input type="hidden" name="film_id" id="film_id">
            <input type="hidden" name="film_title" id="film_title">
            <input type="hidden" name="film_poster_path" id="film_poster_path">
            <div id="movie_suggestions" style="max-width:480px;margin:8px 0"></div>
            <div id="selected_movie" style="margin:8px 0"></div>

            <textarea name="message" placeholder="Message (optionnel)" rows="2"></textarea><br>
            <button type="submit">Partager</button>
        </form>

        <style>
            .suggestion-item{display:flex;gap:8px;align-items:center;padding:6px;border:1px solid #eee;border-radius:6px;margin-bottom:6px;cursor:pointer}
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
                if(!q) { friendSuggestions.innerHTML=''; return }
                const res = await fetch('/api/users/search?q='+encodeURIComponent(q));
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
            movieSearch.addEventListener('input', debounce(e=>fetchMovies(e.target.value)));
        </script>

        <h2>Partages envoyés</h2>
        @if(isset($partages_outgoing) && $partages_outgoing->isEmpty())
            <p>Vous n'avez encore partagé aucun film.</p>
        @else
            <div class="partages-grid">
                @foreach($partages_outgoing as $partage)
                    <div class="partage-card">
                        @if($partage->film_poster_path)
                            <img src="{{ $partage->film_poster_path }}" alt="{{ $partage->film_title }}">
                        @endif
                        <h3>{{ $partage->film_title }}</h3>
                        <p>À : {{ $partage->friend->username ?? 'Utilisateur supprimé' }}</p>
                        @if($partage->message)
                            <p>Message : {{ $partage->message }}</p>
                        @endif
                        <form action="{{ route('partages.destroy', $partage->id) }}" method="POST">
                            @csrf
                            <button type="submit">Supprimer</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

        <h2 style="margin-top:26px">Partages reçus</h2>
        @if(isset($partages_incoming) && $partages_incoming->isEmpty())
            <p>Vous n'avez reçu aucun partage.</p>
        @else
            <div class="partages-grid">
                @foreach($partages_incoming as $partage)
                    <div class="partage-card">
                        @if($partage->film_poster_path)
                            <img src="{{ $partage->film_poster_path }}" alt="{{ $partage->film_title }}">
                        @endif
                        <h3>{{ $partage->film_title }}</h3>
                        <p>De : {{ $partage->user->username ?? 'Utilisateur supprimé' }}</p>
                        @if($partage->message)
                            <p>Message : {{ $partage->message }}</p>
                        @endif
                        <form action="{{ route('partages.destroy', $partage->id) }}" method="POST">
                            @csrf
                            <button type="submit">Supprimer</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
