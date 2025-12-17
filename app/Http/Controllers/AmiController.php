<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        // Fournir une collection vide si la table/modèle n'existe pas encore
        try {
            $amis = \App\Models\FriendUser::where('user_id', Auth::id())->get();
        } catch (\Throwable $e) {
            $amis = collect([]);
        }

        return view('amis.index', ['amis' => $amis]);
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
        
        // Créer une nouvelle amitié si elle n'existe pas
        $friendId = $request->input('ami_id');
        if ($friendId == Auth::id()) {
            return redirect('/mesAmis')->with('error', 'Vous ne pouvez pas vous ajouter vous-même.');
        }

        try {
            $exists = \App\Models\FriendUser::where('user_id', Auth::id())->where('friend_id', $friendId)->exists();
            if (!$exists) {
                \App\Models\FriendUser::create([
                    'user_id' => Auth::id(),
                    'friend_id' => $friendId
                ]);
            }
        } catch (\Throwable $e) {
            return redirect('/mesAmis')->with('error', 'Impossible d\'ajouter cet ami.');
        }

        return redirect('/mesAmis')->with('success', 'Ami ajouté !');
    }

    // Recherche d'utilisateurs pour autocomplete (AJAX)
    public function searchUsers(Request $request)
    {
        $q = $request->query('q');
        if (!$q) {
            return response()->json([]);
        }
        $currentId = Auth::check() ? Auth::id() : 0;

        $users = User::where(function($query) use ($q) {
                $query->where('username', 'like', "%{$q}%")
                      ->orWhere('firstname', 'like', "%{$q}%")
                      ->orWhere('lastname', 'like', "%{$q}%");
            })
            ->where('id', '!=', $currentId)
            ->limit(10)
            ->get(['id', 'username', 'firstname', 'lastname']);

        return response()->json($users);
    }
    
    // Supprime un ami
    public function destroy($ami)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }
        
        try {
            $f = \App\Models\FriendUser::where('id', $ami)->where('user_id', Auth::id())->first();
            if ($f) $f->delete();
        } catch (\Throwable $e) {
            return redirect('/mesAmis')->with('error', 'Impossible de supprimer cet ami.');
        }

        return redirect('/mesAmis')->with('success', 'Ami supprimé !');
    }
}
