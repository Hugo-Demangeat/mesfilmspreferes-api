<?php

use App\Http\Controllers\AmiController;
use App\Http\Controllers\ConnectController;
use App\Http\Controllers\FavoriController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\PartageController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

// Route par défaut (page d'accueil)
Route::get('/', [ConnectController::class, 'index'])->name('accueil');

// Routes publiques
Route::controller(ConnectController::class)->group(function () {
    Route::get('/accueil', 'index'); // optionnel (alias)
    Route::post('/accueil', 'deconnect')->name('deconnection');

    Route::get('/creerCompte', 'showCreateForm')->name('creerCompte');
    Route::post('/creerCompte/ajouter', 'create')->name('creerCompte.create');

    Route::get('/connexion', 'showLoginForm')->name('connexion');
    Route::post('/connexion', 'connect')->name('connexion.connect');
});

// Routes protégées
// API helpers for AJAX searches
Route::get('/api/users/search', [AmiController::class, 'searchUsers'])->name('api.users.search');
Route::get('/api/movies/search', [FilmController::class, 'searchMoviesAjax'])->name('api.movies.search');

Route::controller(FilmController::class)->group(function () {
    Route::get('/rechercher', 'search')->name('films.search');
    Route::post('/rechercher', 'searchFilm')->name('films.searchFilm');
    Route::post('/rechercher/favoris', 'addFavoris')->name('films.addFavoris');
    Route::get('/film/{id}', [FilmController::class, 'show'])->name('films.show');
});

Route::controller(FavoriController::class)->group(function () {
    Route::get('/mesFavoris', 'index')->name('favoris.index');
    Route::post('/mesFavoris/ajouter', 'store')->name('favoris.add');
    Route::post('/mesFavoris/{favori}', 'destroy')->name('favoris.destroy');
    Route::post('/mesFavoris/{favori}/avis', 'updateAvis')->name('favoris.updateAvis');
});

Route::controller(AmiController::class)->group(function () {
    Route::get('/mesAmis', 'index')->name('amis.index');
    Route::post('/mesAmis/ajouter', 'store')->name('amis.add');
    Route::post('/mesAmis/{ami}', 'destroy')->name('amis.destroy');
});

Route::controller(PartageController::class)->group(function () {
    Route::get('/mesPartages', 'index')->name('partages.index');
    Route::post('/mesPartages/ajouter', 'store')->name('partages.add');
    Route::post('/mesPartages/{partage}', 'destroy')->name('partages.destroy');
});

Route::controller(ProfilController::class)->group(function () {
    Route::get('/monProfil', 'index')->name('profil.index');
    Route::post('/monProfil', 'update')->name('profil.update');
    Route::post('/monProfil/avatar', 'uploadAvatar')->name('profil.uploadAvatar');
});