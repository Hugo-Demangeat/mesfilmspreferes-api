<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnectController extends Controller
{
    public function index()
    {
        $upcomingMovies = $this->fetchUpcomingMovies();
        return view('accueil', compact('upcomingMovies'));
    }

    private function fetchUpcomingMovies()
    {
        $apiKey = '63905b28b94957ba2d061a85b849243f';
        $url = "https://api.themoviedb.org/3/movie/upcoming?api_key={$apiKey}&language=fr";

        try {
            $response = @file_get_contents($url);
            if ($response === false) {
                return [];
            }
            $data = json_decode($response, true);
            return $data['results'] ?? [];
        } catch (\Throwable $e) {
            return [];
        }
    }
    
    public function showCreateForm()
    {
        return view('creerCompte');
    }
    
    public function create(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);
        
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        
        session(['user' => $user]);
        Auth::login($user);
        
        return redirect('/rechercher')->with('success', 'Compte créé avec succès !');
    }
    
    public function showLoginForm()
    {
        return view('connexion');
    }

    public function connect(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            session(['user' => Auth::user()]);
            return redirect()->intended('/rechercher')->with('success', 'Connexion réussie !');
        }
        
        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ])->onlyInput('email');
    }

    public function deconnect(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->flush();
        
        return redirect('/accueil')->with('success', 'Vous avez été déconnecté.');
    }
}
