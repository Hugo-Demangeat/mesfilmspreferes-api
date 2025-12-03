<!-- filepath: resources/views/favoris/index.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Favoris - Mes Films Préférés</title>
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
        .films-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; }
        .film-card { border: 1px solid #ddd; border-radius: 5px; padding: 10px; text-align: center; background: #f9f9f9; }
        .film-card img { width: 100%; border-radius: 5px; margin-bottom: 10px; }
        textarea { width: 90%; padding: 5px; margin-bottom: 5px; }
        input[type="number"] { width: 50px; padding: 5px; margin-bottom:5px; }
        button { padding: 5px 10px; border-radius: 5px; border: none; background: #667eea; color: white; cursor: pointer; margin-bottom:5px; }
        button:hover { background: #5568d3; }
        a { text-decoration: none; color: #667eea; font-weight: bold; display: inline-block; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>⭐ Mes Favoris</h1>

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <a href="/rechercher">← Retour à la recherche</a>

        @if($favoris->isEmpty())
            <p>Vous n'avez aucun favori pour le moment.</p>
        @else
            <div class="films-grid">
                @foreach($favoris as $favori)
                    <div class="film-card">
                        @if($favori->film_poster_path)
                            <img src="{{ $favori->film_poster_path }}" alt="{{ $favori->film_title }}">
                        @endif
                        <h3>{{ $favori->film_title }}</h3>
                        <p>{{ $favori->film_overview ?? 'Pas de description.' }}</p>

                        <form action="{{ route('favoris.destroy', $favori->id) }}" method="POST">
                            @csrf
                            <button type="submit">Supprimer</button>
                        </form>

                        <form action="{{ route('favoris.updateAvis', $favori->id) }}" method="POST">
                            @csrf
                            <textarea name="avis" placeholder="Votre avis">{{ $favori->avis }}</textarea>
                            <input type="number" name="note" min="1" max="5" value="{{ $favori->note ?? 3 }}">
                            <button type="submit">Mettre à jour l'avis</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>