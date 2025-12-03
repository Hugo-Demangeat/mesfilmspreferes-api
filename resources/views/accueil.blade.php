<!-- filepath: resources/views/accueil.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Mes Films Préférés</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            padding: 60px 40px;
            text-align: center;
            max-width: 600px;
            width: 100%;
        }
        
        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 2.5em;
        }
        
        p {
            color: #666;
            margin-bottom: 40px;
            font-size: 1.1em;
        }
        
        .buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        a {
            padding: 15px 40px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1em;
            font-weight: bold;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .btn-primary {
            background: #667eea;
            color: white;
        }
        
        .btn-primary:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }
        
        .btn-secondary {
            background: #f093fb;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #e080e8;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(240, 147, 251, 0.4);
        }
        
        .success-message {
            background: #4caf50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 30px;
            display: none;
        }
        
        @if (session('success'))
            .success-message { display: block; }
        @endif
    </style>
</head>
<body>
    <div class="container">
        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif
        
        <h1>🎬 Mes Films Préférés</h1>
        <p>Bienvenue ! Découvrez, partagez et gérez vos films préférés</p>
        
        <div class="buttons">
            @auth
                <form action="{{ route('deconnection') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-primary" style="border: none;">Se déconnecter</button>
                </form>
                <a href="{{ route('films.search') }}" class="btn-secondary">Aller à la recherche</a>
            @else
                <a href="{{ route('connexion') }}" class="btn-primary">Se connecter</a>
                <a href="{{ route('creerCompte') }}" class="btn-secondary">Créer un compte</a>
            @endauth
        </div>
    </div>
</body>
</html>