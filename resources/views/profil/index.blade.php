<!-- filepath: resources/views/profil/index.blade.php -->
@extends('layouts.app')

@section('title','Mon Profil - Mes Films Préférés')

@section('content')
    <div class="container-card" style="max-width:720px;margin:0 auto">
        <h1 style="margin:0 0 14px">👤 Mon Profil</h1>

        @if(session('success'))
            <div style="background:#4caf50;color:#fff;padding:10px;border-radius:8px;margin-bottom:12px;text-align:center">{{ session('success') }}</div>
        @endif

        <div style="text-align:center;margin-bottom:12px;">
            <form action="{{ route('deconnection') }}" method="POST" style="display:inline-block;">
                @csrf
                <button type="submit" style="background:#e05555;border:none;padding:10px 16px;border-radius:8px;color:#fff;cursor:pointer;display:inline-flex;align-items:center;gap:8px" aria-label="Se déconnecter">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    <span>Se déconnecter</span>
                </button>
            </form>
        </div>

        <form action="{{ route('profil.update') }}" method="POST">
            @csrf
            <div style="margin-bottom:12px">
                <label for="firstname" style="display:block;font-weight:700;margin-bottom:6px">Prénom</label>
                <input type="text" id="firstname" name="firstname" value="{{ old('firstname', $user->firstname ?? '') }}" required style="width:100%;padding:10px;border-radius:8px;border:1px solid #eee">
            </div>

            <div style="margin-bottom:12px">
                <label for="lastname" style="display:block;font-weight:700;margin-bottom:6px">Nom</label>
                <input type="text" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname ?? '') }}" required style="width:100%;padding:10px;border-radius:8px;border:1px solid #eee">
            </div>

            <div style="margin-bottom:12px">
                <label for="email" style="display:block;font-weight:700;margin-bottom:6px">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required style="width:100%;padding:10px;border-radius:8px;border:1px solid #eee">
            </div>

            <div style="margin-bottom:12px">
                <label for="password" style="display:block;font-weight:700;margin-bottom:6px">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
                <input type="password" id="password" name="password" style="width:100%;padding:10px;border-radius:8px;border:1px solid #eee">
            </div>

            <div style="margin-bottom:12px">
                <label for="password_confirmation" style="display:block;font-weight:700;margin-bottom:6px">Confirmer le mot de passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation" style="width:100%;padding:10px;border-radius:8px;border:1px solid #eee">
            </div>

            <div style="margin-top:8px">
                <button class="btn-primary" type="submit">Mettre à jour le profil</button>
            </div>
        </form>

        <hr style="margin:20px 0;border-color:#f0f0f0">

        <h2>Avatar</h2>
        @if($user->avatar)
            <img src="{{ asset('avatars/' . $user->avatar) }}" alt="Avatar" style="width:100px;height:100px;border-radius:50%;object-fit:cover;display:block;margin-bottom:12px">
        @endif
        <form action="{{ route('profil.uploadAvatar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="avatar" accept="image/*" required style="margin-bottom:8px"><br>
            <button class="btn-primary" type="submit">Mettre à jour l'avatar</button>
        </form>

        <div style="text-align:center;margin-top:18px">
            <a href="/rechercher" class="btn-secondary">← Retour à la recherche</a>
        </div>
    </div>
@endsection
