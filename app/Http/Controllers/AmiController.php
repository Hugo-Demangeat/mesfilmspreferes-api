<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmiController extends Controller
{
    // Affiche la liste des amis de l'utilisateur
    public function index()
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }
        
        // À implémenter : récupérer les amis de l'utilisateur
        // $amis = Ami::where('user_id', Auth::id())->get();
        
        return view('amis.index');
    }
    
    // Ajoute un ami
    public function store(Request $request)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }
        
        // Validation des données
        $request->validate([
            'ami_id' => 'required|integer'
        ]);
        
        // À implémenter : créer une nouvelle amitié
        // $ami = Ami::create([
        //     'user_id' => Auth::id(),
        //     'ami_id' => $request->ami_id
        // ]);
        
        return redirect('/mesAmis')->with('success', 'Ami ajouté !');
    }
    
    // Supprime un ami
    public function destroy($ami)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }
        
        // À implémenter : supprimer l'amitié
        // Ami::findOrFail($ami)->delete();
        
        return redirect('/mesAmis')->with('success', 'Ami supprimé !');
    }
}
