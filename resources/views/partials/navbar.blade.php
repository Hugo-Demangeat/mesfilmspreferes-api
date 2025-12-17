@auth
<style>
    .topbar{background:var(--glass);padding:10px 16px;box-shadow:0 6px 18px rgba(0,0,0,0.08);border-radius:8px;margin-bottom:18px;color:#e5e7eb}
    .topbar .nav{display:flex;gap:10px;flex-wrap:wrap;justify-content:center}
    .nav .nav-btn{background:var(--accent);color:#fff;padding:10px 14px;border-radius:8px;text-decoration:none;font-weight:600;transition:all .15s;display:inline-flex;align-items:center}
    .nav .nav-btn:hover{filter:brightness(.95);transform:translateY(-2px);box-shadow:0 6px 18px rgba(86,103,211,0.12)}
    .nav .back-btn{background:transparent;color:inherit;border:1px solid rgba(255,255,255,0.12);padding:8px 12px;border-radius:8px;text-decoration:none;font-weight:600;display:inline-flex;align-items:center}
    .nav .back-btn:hover{background:rgba(255,255,255,0.02)}
    @media(max-width:600px){.nav{gap:6px}.nav .nav-btn{padding:8px 10px}}
</style>

<div class="topbar">
    <div class="nav">
        <a class="nav-btn" href="{{ route('films.search') }}" aria-label="Rechercher">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><circle cx="11" cy="11" r="7"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <span style="margin-left:8px">Rechercher</span>
        </a>

        <a class="nav-btn" href="{{ route('favoris.index') }}" aria-label="Favoris">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
            <span style="margin-left:8px">Favoris</span>
        </a>

        <a class="nav-btn" href="{{ route('amis.index') }}" aria-label="Amis">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zM8 11c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm8 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
            <span style="margin-left:8px">Amis</span>
        </a>

        <a class="nav-btn" href="{{ route('partages.index') }}" aria-label="Partages">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><path d="M4 12v7a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-7" stroke="currentColor"/><polyline points="16 6 12 2 8 6" stroke="currentColor"/><line x1="12" y1="2" x2="12" y2="15" stroke="currentColor"/></svg>
            <span style="margin-left:8px">Partages</span>
        </a>

        <a class="nav-btn" href="{{ route('profil.index') }}" aria-label="Profil">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a6.5 6.5 0 0 1 13 0"/></svg>
            <span style="margin-left:8px">Profil</span>
        </a>

        <a class="back-btn" href="javascript:history.back()" aria-label="Retour">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><polyline points="15 18 9 12 15 6"/></svg>
            <span style="margin-left:8px">Retour</span>
        </a>

        <a class="back-btn" href="{{ route('accueil') }}" aria-label="Accueil">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><path d="M3 9.5L12 3l9 6.5V21a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V9.5z"/></svg>
            <span style="margin-left:8px">Accueil</span>
        </a>
    </div>
</div>
@endauth
