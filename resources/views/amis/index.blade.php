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
        @auth
            @include('partials.navbar')
        @endauth
        <h1>👥 Mes Amis</h1>

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <a href="/rechercher">← Retour à la recherche</a>

        <h2>Ajouter un ami</h2>
        <form action="{{ route('amis.add') }}" method="POST">
            @csrf
            <input type="text" id="friend_search" placeholder="Tapez nom ou pseudo...">
            <input type="hidden" name="ami_id" id="ami_id">
            <div id="friend_suggestions" style="max-width:480px;margin:8px 0"></div>
            <button type="submit">Ajouter</button>
        </form>

        <style>
            .suggestion-item{display:flex;gap:8px;align-items:center;padding:6px;border:1px solid #eee;border-radius:6px;margin-bottom:6px;cursor:pointer}
            .suggestion-item:hover{background:#f5f7ff}
        </style>

        <script>
            const friendSearch = document.getElementById('friend_search');
            const friendSuggestions = document.getElementById('friend_suggestions');
            const amiIdInput = document.getElementById('ami_id');

            function debounce(fn, delay=300){let t;return (...args)=>{clearTimeout(t);t=setTimeout(()=>fn(...args),delay)}}

            async function fetchUsers(q){
                if(!q) { friendSuggestions.innerHTML=''; return }
                const res = await fetch('/api/users/search?q='+encodeURIComponent(q));
                const data = await res.json();
                friendSuggestions.innerHTML='';
                data.forEach(u=>{
                    const el = document.createElement('div');
                    el.className='suggestion-item';
                    el.innerHTML = `<div><strong>${u.firstname} ${u.lastname}</strong><div style="font-size:12px;color:#666">@${u.username}</div></div>`;
                    el.addEventListener('click', ()=>{
                        friendSearch.value = u.firstname + ' ' + u.lastname + ' (@'+u.username+')';
                        amiIdInput.value = u.id;
                        friendSuggestions.innerHTML='';
                    });
                    friendSuggestions.appendChild(el);
                })
            }

            friendSearch.addEventListener('input', debounce(e=>fetchUsers(e.target.value)));
        </script>

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
