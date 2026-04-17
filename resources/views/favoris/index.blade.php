<!-- filepath: resources/views/favoris/index.blade.php -->
@extends('layouts.app')

@section('title','Mes Favoris - Mes Films Préférés')

@section('content')
    <div class="container-card">
        <h1 style="margin:0 0 14px">⭐ Mes Favoris</h1>

        @if(session('success'))
            <div style="background:#4caf50;color:#fff;padding:10px;border-radius:8px;margin-bottom:12px;text-align:center">{{ session('success') }}</div>
        @endif

        <a href="/rechercher" class="btn-secondary" style="display:inline-block;margin-bottom:14px">← Retour à la recherche</a>

        @if($favoris->isEmpty())
            <p>Vous n'avez aucun favori pour le moment.</p>
        @else
            <div class="films-grid {{ $favoris->count() === 1 ? 'single-film' : '' }}">
                @foreach($favoris as $favori)
                    <div class="film-card">
                        @if($favori->film_poster_path)
                            <img src="{{ $favori->film_poster_path }}" alt="{{ $favori->film_title }}">
                        @endif
                        <div class="meta">
                            <h3 style="margin:8px 0">{{ $favori->film_title }}</h3>
                            <p style="color:var(--muted);font-size:14px">{{ \Illuminate\Support\Str::limit($favori->film_overview ?? 'Pas de description.', 140) }}</p>

                            <form action="{{ route('favoris.destroy', $favori->id) }}" method="POST" style="margin-top:10px">
                                @csrf
                                <button class="btn-primary" type="submit">Supprimer</button>
                            </form>

                            <form action="{{ route('favoris.updateAvis', $favori->id) }}" method="POST" style="margin-top:8px">
                                @csrf
                                <textarea name="avis" placeholder="Votre avis" rows="2" style="width:100%;padding:8px;border-radius:6px;border:1px solid #eee">{{ old('avis', $favori->avis) }}</textarea>
                                @php
                                    $favoriNote = old('note');
                                    if (is_null($favoriNote)) {
                                        $favoriNote = $favori->avisRecords->first()->rating ?? '';
                                    }
                                @endphp
                                <div style="display:flex;gap:8px;align-items:center;margin-top:8px">
                                    <input type="number" name="note" min="1" max="5" value="{{ $favoriNote }}" placeholder="1-5" style="width:64px;padding:8px;border-radius:6px;border:1px solid #eee">
                                    <button class="btn-primary" type="submit">Mettre à jour</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection