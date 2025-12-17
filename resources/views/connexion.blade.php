<!-- filepath: resources/views/connexion.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Mes Films Préférés</title>
    @include('partials.auth-styles')
</head>
<body>
    <div class="container">
        <h1>Se connecter</h1>
        
        <form action="{{ route('connexion.connect') }}" method="POST">
            @csrf
            
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
            
            <div class="auth-actions">
                <button type="submit" class="btn-primary" aria-label="Se connecter">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                    <span class="label">Se connecter</span>
                </button>

                <a href="{{ route('accueil') }}" class="btn-secondary" aria-label="Accueil">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><path d="M3 9.5L12 3l9 6.5V21a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V9.5z"/></svg>
                    <span class="label">Accueil</span>
                </a>
            </div>
        </form>
        
        <div class="link">
            Vous n'avez pas de compte ? <a href="{{ route('creerCompte') }}">Créer un compte</a>
        </div>
    </div>
</body>
</html>