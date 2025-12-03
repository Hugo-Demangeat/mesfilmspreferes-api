<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $film['title'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fafafa;
            padding: 40px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        img {
            width: 300px;
            border-radius: 8px;
        }

        h1 {
            margin-top: 10px;
        }

        button {
            margin-top: 20px;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #667eea;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>{{ $film['title'] }}</h1>

    @if($film['poster_path'])
        <img src="https://image.tmdb.org/t/p/w500{{ $film['poster_path'] }}">
    @endif

    <p><strong>Résumé :</strong><br>{{ $film['overview'] ?: 'Pas de résumé disponible.' }}</p>

    <form action="{{ route('films.addFavoris') }}" method="POST">
        @csrf
        <input type="hidden" name="film_id" value="{{ $film['id'] }}">
        <input type="hidden" name="titre" value="{{ $film['title'] }}">
        <button type="submit">Ajouter aux favoris ⭐</button>
    </form>

    <a href="{{ route('films.search') }}">⬅ Retour</a>

</div>

</body>
</html>