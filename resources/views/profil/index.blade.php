<!-- filepath: resources/views/profil/index.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Mes Films Préférés</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh; padding: 20px;
        }
        .container {
            max-width: 600px; margin: 50px auto; background: white;
            border-radius: 10px; padding: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }
        h1 { text-align: center; margin-bottom: 30px; }
        .success-message { background: #4caf50; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align:center; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        button { padding: 10px 20px; border-radius: 5px; border: none; background: #667eea; color: white; cursor: pointer; margin-top: 10px; }
        button:hover { background: #5568d3; }
        img.avatar { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; display: block; margin-bottom: 15px; }
        .link { text-align: center; margin-top: 20px; }
        .link a { color: #667eea; font-weight: bold; text-decoration: none; }
        .link a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        @auth
            @include('partials.navbar')
        @endauth

        <h1>👤 Mon Profil</h1>

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
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
            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="firstname" value="{{ old('firstname', $user->firstname ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="lastname">Nom</label>
                <input type="text" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
                <input type="password" id="password" name="password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit">Mettre à jour le profil</button>
        </form>

        <hr style="margin:20px 0;">

        <h2>Avatar</h2>
        @if($user->avatar)
            <img src="{{ asset('avatars/' . $user->avatar) }}" alt="Avatar" class="avatar">
        @endif
        <form action="{{ route('profil.uploadAvatar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="avatar" accept="image/*" required><br>
            <button type="submit">Mettre à jour l'avatar</button>
        </form>

        <div class="link">
            <a href="/rechercher">← Retour à la recherche</a>
        </div>
    </div>
</body>
</html>
