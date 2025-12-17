<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de Films</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 30px;
            color: #333;
        }

        .container {
            background: #fff;
            max-width: 1200px;
            width: 100%;
            margin: auto;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.3em;
            color: #444;
        }

        form {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-bottom: 40px;
        }

        input[type="text"] {
            padding: 12px;
            width: 60%;
            border-radius: 5px;
            border: 1px solid #bbb;
            font-size: 1em;
        }

        button {
            padding: 12px 30px;
            background: #667eea;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        button:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .films-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .film {
            display: flex;
            flex-direction: column;
            background: #fafafa;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            cursor: pointer;
            transition: 0.2s ease;
            text-align: center;
        }

        .film:hover {
            background: #eee;
            transform: scale(1.02);
        }

        .poster {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .film-title {
            font-size: 1.1em;
            font-weight: bold;
            color: #333;
        }

    </style>
</head>
<body>

</body>
@extends('layouts.app')

@section('title','Recherche de films')

@section('content')
    <div style="display:flex;justify-content:space-between;gap:20px;align-items:center;margin-bottom:18px">
        <h1 style="margin:0">Recherche de films</h1>
        <form action="{{ route('films.searchFilm') }}" method="POST" style="display:flex;gap:8px;align-items:center">
            @csrf
            <input type="text" name="titre" placeholder="Titre du film…" value="{{ $titre ?? '' }}" style="padding:10px;border-radius:8px;border:1px solid #e5e7eb">
            <button class="btn-primary" type="submit">Rechercher</button>
        </form>
    </div>

    @isset($films)
        <h2 style="margin-top:6px">Résultats pour : <strong>"{{ $titre }}"</strong></h2>

        @if (count($films) === 0)
            <p style="color:#6b7280">Aucun film trouvé.</p>
        @else
            <div class="films-grid" style="margin-top:12px">
                @foreach ($films as $film)
                    <a class="film-card" href="{{ route('films.show', $film['id']) }}">
                        @if(!empty($film['poster_path']))
                            <img src="https://image.tmdb.org/t/p/w300{{ $film['poster_path'] }}" alt="{{ $film['title'] }}">
                        @else
                            <img src="https://via.placeholder.com/300x450?text=Pas+d'affiche" alt="Pas d'affiche">
                        @endif
                        <div class="meta">
                            <div style="font-weight:700">{{ $film['title'] }}</div>
                            <div style="color:#6b7280;font-size:13px">{{ $film['release_date'] ?? '' }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    @endisset
@endsection