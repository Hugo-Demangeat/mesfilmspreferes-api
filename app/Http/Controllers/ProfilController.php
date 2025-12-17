<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    // Affiche le profil de l'utilisateur
    public function index()
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }
        // Récupérer les infos de l'utilisateur (passer l'objet user à la vue)
        $user = Auth::user();

        return view('profil.index', ['user' => $user]);
    }
    
    // Met à jour les informations du profil
    public function update(Request $request)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }
        
        // Validation des données
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed'
        ]);
        
        // À implémenter : mettre à jour l'utilisateur
        // $user = Auth::user();
        // $user->update([
        //     'firstname' => $request->firstname,
        //     'lastname' => $request->lastname,
        //     'email' => $request->email
        // ]);
        // if ($request->password) {
        //     $user->password = bcrypt($request->password);
        //     $user->save();
        // }
        
        return redirect('/monProfil')->with('success', 'Profil mis à jour avec succès !');
    }
    
    // Upload l'avatar de l'utilisateur
    public function uploadAvatar(Request $request)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', 'Veuillez vous connecter.');
        }
        
        // Validation du fichier
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        // Récupérer l'utilisateur
        $user = Auth::user();
        
        // Supprimer l'ancien avatar s'il existe
        if ($user->avatar && file_exists(public_path('avatars/' . $user->avatar))) {
            unlink(public_path('avatars/' . $user->avatar));
        }
        
        // Stocker le nouvel avatar
        $filename = time() . '_' . $request->file('avatar')->getClientOriginalName();
        $request->file('avatar')->move(public_path('avatars'), $filename);
        
        // Mettre à jour la base de données
        $user->avatar = $filename;
        $user->save();
        
        return redirect('/monProfil')->with('success', 'Avatar mis à jour !');
    }
}
