<!-- filepath: resources/views/amis/index.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Amis - Mes Films Préférés</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh; padding: 20px;
        }
        .container {
            max-width: 900px; margin: 50px auto; background: white;
            border-radius: 10px; padding: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }
        h1 { text-align: center; margin-bottom: 30px; }
        .success-message { background: #4caf50; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align:center; }
        .amis-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; }
        .ami-card { border: 1px solid #ddd; border-radius: 5px; padding: 10px; text-align: center; background: #f9f9f9; }
        button { padding: 5px 10px; border-radius: 5px; border: none; background: #667eea; color: white; cursor: pointer; margin-top: 5px; }
        button:hover { background: #5568d3; }
        input { width: 80%; padding: 5px; margin-bottom: 5px; }
        a { text-decoration: none; color: #667eea; font-weight: bold; display: inline-block; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>👥 Mes Amis</h1>

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <a href="/rechercher">← Retour à la recherche</a>

        <h2>Ajouter un ami</h2>
        <form action="{{ route('amis.add') }}" method="POST">
            @csrf
            <input type="number" name="ami_id" placeholder="ID de l'ami" required>
            <button type="submit">Ajouter</button>
        </form>

        @if($amis->isEmpty())
            <p>Vous n'avez pas encore d'amis.</p>
        @else
            <div class="amis-grid">
                @foreach($amis as $ami)
                    <div class="ami-card">
                        <h3>{{ $ami->friend->username ?? 'Utilisateur supprimé' }}</h3>
                        <p>{{ $ami->friend->firstname ?? '' }} {{ $ami->friend->lastname ?? '' }}</p>

                        <form action="{{ route('amis.destroy', $ami->id) }}" method="POST">
                            @csrf
                            <button type="submit">Supprimer</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
