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
        // $partages = Partage::where('user_id', Auth::id())->get();
        
        return view('partages.index');
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
        
        // À implémenter : créer un nouveau partage
        // $partage = Partage::create([
        //     'user_id' => Auth::id(),
        //     'film_id' => $request->film_id,
        //     'ami_id' => $request->ami_id,
        //     'message' => $request->message
        // ]);
        
        return redirect('/mesPartages')->with('success', 'Film partagé avec succès !');
    }
    
    // Supprime un partage
    public function destroy($partage)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }
        
        // À implémenter : supprimer le partage
        // Partage::findOrFail($partage)->delete();
        
        return redirect('/mesPartages')->with('success', 'Partage supprimé !');
    }
}
