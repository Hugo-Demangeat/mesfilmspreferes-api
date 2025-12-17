<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartageController extends Controller
{
    // Affiche la liste des partages de l'utilisateur
    public function index()
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }
        // À implémenter : récupérer les partages de l'utilisateur
        // Fournir une collection vide si la table/modèle n'existe pas encore
        try {
            $outgoing = \App\Models\Partage::where('user_id', Auth::id())->with('friend')->get();
            $incoming = \App\Models\Partage::where('friend_id', Auth::id())->with('user')->get();
        } catch (\Throwable $e) {
            $outgoing = collect([]);
            $incoming = collect([]);
        }

        return view('partages.index', ['partages_outgoing' => $outgoing, 'partages_incoming' => $incoming]);
    }
    
    // Ajoute un partage (partage un film avec un ami)
    public function store(Request $request)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }
        
        // Validation des données
        $request->validate([
            'film_id' => 'required|integer',
            'ami_id' => 'required|integer',
            'message' => 'nullable|string|max:500'
        ]);
        
        $request->validate([
            'film_id' => 'required|integer',
            'ami_id' => 'required|integer',
            'film_title' => 'nullable|string'
        ]);

        try {
            \App\Models\Partage::create([
                'user_id' => Auth::id(),
                'favori_id' => null,
                'film_title' => $request->input('film_title', ''),
                'film_poster_path' => $request->input('film_poster_path'),
                'film_tmdb_id' => $request->input('film_id'),
                'friend_id' => $request->input('ami_id'),
                'message' => $request->input('message')
            ]);
        } catch (\Throwable $e) {
            return redirect('/mesPartages')->with('error', 'Impossible de partager le film.');
        }

        return redirect('/mesPartages')->with('success', 'Film partagé avec succès !');
    }
    
    // Supprime un partage
    public function destroy($partage)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }
        
        try {
            $p = \App\Models\Partage::find($partage);
            if ($p && ($p->user_id == Auth::id() || $p->friend_id == Auth::id())) {
                $p->delete();
            }
        } catch (\Throwable $e) {
            return redirect('/mesPartages')->with('error', 'Impossible de supprimer ce partage.');
        }

        return redirect('/mesPartages')->with('success', 'Partage supprimé !');
    }
}
