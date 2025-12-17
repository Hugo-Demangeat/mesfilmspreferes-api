@extends('layouts.app')

@section('title', $film['title'] ?? 'Détails film')

@section('content')
    <div class="container-card">
        <div class="film-detail">
            <div class="film-poster">
                @if($film['poster_path'])
                    <img src="https://image.tmdb.org/t/p/w500{{ $film['poster_path'] }}" style="width:100%;display:block">
                @else
                    <div style="width:100%;height:420px;background:#eee;display:flex;align-items:center;justify-content:center">Pas d'affiche</div>
                @endif
            </div>

            <div class="film-meta">
                <h1 class="film-title">{{ $film['title'] }}</h1>
                <div class="film-sub">{{ $film['release_date'] ?? '' }} • {{ $film['runtime'] ?? '' }} min</div>
                        <p class="film-overview">{{ $film['overview'] ?: 'Pas de résumé disponible.' }}</p>

                        @if(!empty($film['vote_average']))
                            <div style="margin-top:10px;font-weight:700">Note TMDB: {{ $film['vote_average'] }} / 10</div>
                        @endif

                        <form action="{{ route('films.addFavoris') }}" method="POST" style="margin-top:18px">
                            @csrf
                            <input type="hidden" name="film_id" value="{{ $film['id'] }}">
                            <input type="hidden" name="titre" value="{{ $film['title'] }}">
                            <button class="btn-primary" type="submit">Ajouter aux favoris</button>
                            <a href="{{ route('films.search') }}" class="btn-secondary" style="margin-left:10px">Retour à la recherche</a>
                        </form>

                        @if(!empty($trailer))
                            <div style="margin-top:20px">
                                <h3>Bande-annonce</h3>
                                <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:8px">
                                    <iframe src="https://www.youtube.com/embed/{{ $trailer['key'] }}" style="position:absolute;top:0;left:0;width:100%;height:100%;border:0" allowfullscreen></iframe>
                                </div>
                            </div>
                        @endif

                        @if(!empty($cast))
                            <div style="margin-top:20px">
                                <h3>Distribution principale</h3>
                                <div style="display:flex;gap:12px;overflow:auto;padding-top:8px">
                                    @foreach(array_slice($cast,0,10) as $c)
                                        <div style="width:110px;text-align:center">
                                            @if(!empty($c['profile_path']))
                                                <img src="https://image.tmdb.org/t/p/w154{{ $c['profile_path'] }}" style="width:100%;height:150px;object-fit:cover;border-radius:6px">
                                            @else
                                                <div style="width:100%;height:150px;background:#eee;border-radius:6px"></div>
                                            @endif
                                            <div style="font-weight:700;margin-top:6px">{{ $c['name'] }}</div>
                                            <div style="color:#6b7280;font-size:13px">{{ $c['character'] ?? '' }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
            </div>
        </div>
    </div>
@endsection