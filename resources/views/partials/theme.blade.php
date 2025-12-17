<style>
    :root{
        --accent:#e50914; /* allocine-like red accent */
        --primary:#0b1226;
        --muted:#6b7280;
        --card:#ffffff;
        --radius:10px;
        --glass: rgba(255,255,255,0.03);
    }
    html,body{height:100%;margin:0;font-family:Inter,system-ui,Segoe UI,Roboto,'Helvetica Neue',Arial}
    body{background:linear-gradient(180deg,#0f1724 0%,#08101b 60%);color:#e5e7eb}
    /* ensure cards (white) have dark text for readability */
    .container-card{color:var(--primary)}
    /* layout */
    main{min-height:60vh}
    .container-card{background:var(--card);border-radius:var(--radius);box-shadow:0 10px 30px rgba(2,6,23,0.2);padding:22px}

    /* buttons */
    .btn-primary{background:var(--accent);color:#fff;padding:10px 14px;border-radius:8px;text-decoration:none;font-weight:700;border:none}
    .btn-secondary{background:#fff;color:var(--primary);padding:8px 12px;border-radius:8px;border:1px solid #eee;text-decoration:none;font-weight:700}

    /* film detail */
    .film-detail{display:flex;gap:24px;align-items:flex-start}
    .film-poster{width:280px;flex:0 0 280px;border-radius:8px;overflow:hidden}
    .film-meta{flex:1}
    .film-title{font-size:28px;font-weight:800;margin:0 0 6px}
    .film-sub{color:var(--muted);margin-bottom:12px}
    .film-overview{line-height:1.6;color:#333}

    /* search grid */
    .films-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:18px}
    .film-card{background:#fff;border-radius:8px;overflow:hidden;text-decoration:none;color:inherit;box-shadow:0 8px 20px rgba(2,6,23,0.06)}
    .film-card img{width:100%;height:270px;object-fit:cover}
    .film-card .meta{padding:10px}

    @media(max-width:900px){.film-detail{flex-direction:column}.film-poster{width:100%;height:auto;}}
</style>
