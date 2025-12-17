<!-- filepath: resources/views/creerCompte.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte - Mes Films Préférés</title>
    @include('partials.auth-styles')
</head>
<body>
    <div class="container">
        <h1>Créer un compte</h1>
        
        <form action="{{ route('creerCompte.create') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" required>
                @error('firstname')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="lastname">Nom</label>
                <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" required>
                @error('lastname')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                @error('username')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            
            <div class="auth-actions">
                <button type="submit" class="btn-primary" aria-label="Créer mon compte">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h11"/><path d="M17 3l4 4"/><path d="M7 11l6 6"/></svg>
                    <span class="label">Créer mon compte</span>
                </button>

                <a href="{{ route('connexion') }}" class="btn-secondary" aria-label="Se connecter">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                    <span class="label">Se connecter</span>
                </a>
            </div>
        </form>
        
        <div class="link">
            Vous avez déjà un compte ? <a href="{{ route('connexion') }}">Se connecter</a>
        </div>
        <div class="link">
            <a href="{{ route('accueil') }}">← Retour à l'accueil</a>
        </div>
    </div>
</body>
</html>
