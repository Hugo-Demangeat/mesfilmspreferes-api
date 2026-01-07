<!-- filepath: resources/views/amis/index.blade.php -->
@extends('layouts.app')

@section('title','Mes Amis - Mes Films Préférés')

@section('content')
    <div class="container-card">
        <h1 style="margin:0 0 14px">👥 Mes Amis</h1>

        @if(session('success'))
            <div style="background:#4caf50;color:#fff;padding:10px;border-radius:8px;margin-bottom:12px;text-align:center">{{ session('success') }}</div>
        @endif

        <a href="/rechercher" class="btn-secondary" style="display:inline-block;margin-bottom:14px">← Retour à la recherche</a>

        <h2 style="margin-top:6px">Ajouter un ami</h2>
        <form action="{{ route('amis.add') }}" method="POST">
            @csrf
            <input type="text" id="friend_search" placeholder="Tapez nom ou pseudo..." style="width:100%;padding:10px;border-radius:8px;border:1px solid #eee">
            <input type="hidden" name="ami_id" id="ami_id">
            <div id="friend_suggestions" style="max-width:480px;margin:8px 0"></div>
            <div style="margin-top:8px"><button class="btn-primary" type="submit">Ajouter</button></div>
        </form>

        <style>
            .suggestion-item{display:flex;gap:8px;align-items:center;padding:8px;border:1px solid #eee;border-radius:8px;margin-bottom:8px;cursor:pointer}
            .suggestion-item:hover{background:#f5f7ff}
        </style>

        <script>
            const friendSearch = document.getElementById('friend_search');
            const friendSuggestions = document.getElementById('friend_suggestions');
            const amiIdInput = document.getElementById('ami_id');

            function debounce(fn, delay=300){let t;return (...args)=>{clearTimeout(t);t=setTimeout(()=>fn(...args),delay)}}

            async function fetchUsers(q){
                // allow empty q: server will return list of users
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
            friendSearch.addEventListener('focus', ()=>fetchUsers(friendSearch.value));
        </script>

        @if($amis->isEmpty())
            <p>Vous n'avez pas encore d'amis.</p>
        @else
            <div class="amis-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:18px;margin-top:12px">
                @foreach($amis as $ami)
                    <div class="film-card" style="padding:12px">
                        <h3 style="margin:6px 0">{{ $ami->friend->username ?? 'Utilisateur supprimé' }}</h3>
                        <p style="color:var(--muted)">{{ $ami->friend->firstname ?? '' }} {{ $ami->friend->lastname ?? '' }}</p>

                        <form action="{{ route('amis.destroy', $ami->id) }}" method="POST" style="margin-top:10px">
                            @csrf
                            <button class="btn-primary" type="submit">Supprimer</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
