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
        // $favoris = Favori::where('user_id', Auth::id())->get();
        
        return view('favoris.index');
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
        
        // À implémenter : créer un nouveau favori
        // $favori = Favori::create([
        //     'user_id' => Auth::id(),
        //     'film_id' => $request->film_id,
        //     'titre' => $request->titre
        // ]);
        
        return redirect('/mesFavoris')->with('success', 'Film ajouté aux favoris !');
    }
    
    // Supprime un film des favoris
    public function destroy($favori)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }
        
        // À implémenter : supprimer le favori
        // Favori::findOrFail($favori)->delete();
        
        return redirect('/mesFavoris')->with('success', 'Film supprimé des favoris !');
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
            'avis' => 'required|string|max:500',
            'note' => 'required|integer|between:1,5'
        ]);
        
        // À implémenter : mettre à jour l'avis
        // $favoriObj = Favori::findOrFail($favori);
        // $favoriObj->update([
        //     'avis' => $request->avis,
        //     'note' => $request->note
        // ]);
        
        return redirect('/mesFavoris')->with('success', 'Avis mis à jour !');
    }
}
