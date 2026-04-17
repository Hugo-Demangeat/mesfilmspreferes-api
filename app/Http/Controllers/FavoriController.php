<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriController extends Controller
{
    // Affiche la liste des favoris de l'utilisateur
    public function index()
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }
        // À implémenter : récupérer les favoris de l'utilisateur
        // Si la table n'existe pas encore, fournir une collection vide pour éviter les erreurs dans la vue
        try {
            $favoris = \App\Models\Favori::with(['avisRecords' => function ($query) {
                $query->where('user_id', Auth::id())->latest('created_at');
            }])->where('user_id', Auth::id())->get();
        } catch (\Throwable $e) {
            $favoris = collect([]);
        }

        return view('favoris.index', ['favoris' => $favoris]);
    }
    
    // Ajoute un film aux favoris
    public function store(Request $request)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }
        
        // Validation des données
        $request->validate([
            'film_id' => 'required|integer',
            'titre' => 'required|string'
        ]);
        
        $filmId = (string) $request->input('film_id');
        $titre = $request->input('titre');
        try {
            $exists = \App\Models\Favori::where('user_id', Auth::id())->where('favori_id', $filmId)->exists();
            if (!$exists) {
                \App\Models\Favori::create([
                    'favori_id' => $filmId,
                    'film_title' => $titre,
                    'film_poster_path' => $request->input('film_poster_path'),
                    'film_overview' => $request->input('film_overview'),
                    'user_id' => Auth::id()
                ]);
            }
            return redirect('/mesFavoris')->with('success', 'Film ajouté aux favoris !');
        } catch (\Throwable $e) {
            return redirect('/mesFavoris')->with('error', 'Impossible d\'ajouter le favori.');
        }
    }
    
    // Supprime un film des favoris
    public function destroy($favori)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }
        
        try {
            $f = \App\Models\Favori::where('id', $favori)->where('user_id', Auth::id())->first();
            if ($f) $f->delete();
            return redirect('/mesFavoris')->with('success', 'Film supprimé des favoris !');
        } catch (\Throwable $e) {
            return redirect('/mesFavoris')->with('error', 'Impossible de supprimer le favori.');
        }
    }
    
    // Met à jour l'avis sur un film favori
    public function updateAvis(Request $request, $favori)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }
        
        // Validation des données
        $request->validate([
            'avis' => 'nullable|string|max:500',
            'note' => 'required|integer|between:1,5'
        ]);
        
        try {
            $favoriObj = \App\Models\Favori::where('id', $favori)->where('user_id', Auth::id())->firstOrFail();

            $hasNewAvis = $request->filled('avis');
            $avisText = $request->input('avis');

            // Create or update an 'Avi' (avis) record linked to this favori and user
            $avi = \App\Models\Avi::where('favori_id', $favoriObj->id)->where('user_id', Auth::id())->first();
            if ($avi) {
                $avi->rating = $request->input('note');
                if ($hasNewAvis) {
                    $avi->texte = $avisText;
                }
                $avi->save();
            } else {
                \App\Models\Avi::create([
                    'favori_id' => $favoriObj->id,
                    'user_id' => Auth::id(),
                    'rating' => $request->input('note'),
                    'texte' => $avisText
                ]);
            }

            if ($hasNewAvis) {
                $favoriObj->avis = $avisText;
                $favoriObj->save();
            }

            return redirect('/mesFavoris')->with('success', 'Avis mis à jour !');
        } catch (\Throwable $e) {
            return redirect('/mesFavoris')->with('error', 'Impossible de mettre à jour l\'avis.');
        }
    }
}
