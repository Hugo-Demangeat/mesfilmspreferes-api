<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class FilmController extends Controller
{
    // Affiche la page de recherche de films
    public function search()
    {
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }

        return view('films.search');
    }

    // Lance la recherche via l'API
    public function searchFilm(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }

        // Validation
        $request->validate([
            'titre' => 'required|string|min:2'
        ]);

        $titre = $request->input('titre');

        // Appel à l'API TMDB
        $films = $this->callApi($titre);

        // Si erreur API
        if (isset($films['error'])) {
            return view('films.search', [
                'error' => $films['error'],
                'titre' => $titre
            ]);
        }

        return view('films.search', [
            'titre'  => $titre,
            'films'  => $films
        ]);
    }

    // Méthode interne d'appel API (version file_get_contents)
    private function callApi($query)
    {
        $apiKey = '63905b28b94957ba2d061a85b849243f';
        $query = urlencode($query);

        // URL API TMDB
        $url = "https://api.themoviedb.org/3/search/movie?query={$query}&api_key={$apiKey}";

        try {
            // Récupération des données depuis l'API
            $response = file_get_contents($url);

            if ($response === false) {
                throw new \Exception('Erreur lors de la requête API');
            }

            // Décodage JSON → tableau associatif
            $data = json_decode($response, true);

            if (isset($data['results'])) {
                return $data['results'];
            }

            return [];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function show($id)
    {
        $apiKey = '63905b28b94957ba2d061a85b849243f';

        try {
            // Details
            $url = "https://api.themoviedb.org/3/movie/{$id}?api_key={$apiKey}&language=fr";
            $response = @file_get_contents($url);
            if ($response === false) abort(404);
            $film = json_decode($response, true);

            // Credits (cast)
            $urlCredits = "https://api.themoviedb.org/3/movie/{$id}/credits?api_key={$apiKey}&language=fr";
            $respCredits = @file_get_contents($urlCredits);
            $credits = $respCredits ? json_decode($respCredits, true) : null;
            $cast = $credits['cast'] ?? [];

            // Videos (trailers)
            $urlVideos = "https://api.themoviedb.org/3/movie/{$id}/videos?api_key={$apiKey}&language=fr";
            $respVideos = @file_get_contents($urlVideos);
            $videos = $respVideos ? json_decode($respVideos, true) : null;
            $trailer = null;
            if (!empty($videos['results'])) {
                foreach ($videos['results'] as $v) {
                    if ((strtolower($v['type'] ?? '') === 'trailer' || strtolower($v['type'] ?? '') === 'teaser') && strtolower($v['site'] ?? '') === 'youtube') {
                        $trailer = $v; break;
                    }
                }
            }

            return view('films.show', compact('film', 'cast', 'trailer'));
        } catch (\Throwable $e) {
            // fallback: try to show basic details
            $url = "https://api.themoviedb.org/3/movie/{$id}?api_key={$apiKey}&language=fr";
            $response = @file_get_contents($url);
            if (!$response) abort(404);
            $film = json_decode($response, true);
            return view('films.show', compact('film'));
        }
    }

    // Endpoint AJAX pour rechercher des films (retour JSON)
    public function searchMoviesAjax(Request $request): JsonResponse
    {
        $q = $request->query('q');
        if (!$q) {
            return response()->json([]);
        }

        $results = $this->callApi($q);
        if (isset($results['error'])) {
            return response()->json([]);
        }

        $slice = array_slice($results, 0, 10);
        $mapped = array_map(function ($m) {
            return [
                'id' => $m['id'] ?? null,
                'title' => $m['title'] ?? ($m['name'] ?? ''),
                'poster_path' => $m['poster_path'] ?? null,
                'release_date' => $m['release_date'] ?? null,
            ];
        }, $slice);

        return response()->json($mapped);
    }


    // Ajoute un film aux favoris
    public function addFavoris(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }

        // Validation
        $request->validate([
            'film_id' => 'required|integer',
            'titre'   => 'required|string'
        ]);

        // (À implémenter plus tard)
        // Favori::create([
        //     'user_id' => Auth::id(),
        //     'film_id' => $request->film_id,
        //     'titre'   => $request->titre
        // ]);

        return back()->with('success', 'Film ajouté aux favoris !');
    }
}