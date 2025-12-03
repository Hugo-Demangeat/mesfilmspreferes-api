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
        <h1>📤 Mes Partages</h1>

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <a href="/rechercher">← Retour à la recherche</a>

        <h2>Partager un film avec un ami</h2>
        <form action="{{ route('partages.add') }}" method="POST">
            @csrf
            <input type="number" name="film_id" placeholder="ID du film" required><br>
            <input type="number" name="ami_id" placeholder="ID de l'ami" required><br>
            <textarea name="message" placeholder="Message (optionnel)" rows="2"></textarea><br>
            <button type="submit">Partager</button>
        </form>

        @if($partages->isEmpty())
            <p>Vous n'avez encore partagé aucun film.</p>
        @else
            <div class="partages-grid">
                @foreach($partages as $partage)
                    <div class="partage-card">
                        @if($partage->film_poster_path)
                            <img src="{{ $partage->film_poster_path }}" alt="{{ $partage->film_title }}">
                        @endif
                        <h3>{{ $partage->film_title }}</h3>
                        <p>Avec : {{ $partage->friend->username ?? 'Utilisateur supprimé' }}</p>
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
