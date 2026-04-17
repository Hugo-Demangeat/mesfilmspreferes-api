<style>
    :root {
        --accent: #e50914;
        --accent-soft: #ffe2e5;
        --bg: #06101d;
        --surface: #ffffff;
        --surface-soft: #f8fafc;
        --text: #0f1724;
        --text-soft: #475569;
        --muted: #64748b;
        --border: rgba(15, 23, 42, 0.08);
        --radius: 24px;
        --radius-sm: 14px;
        --shadow: 0 24px 80px rgba(15, 23, 42, 0.12);
        --glass: rgba(255, 255, 255, 0.06);
        --font: Inter, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    *, *::before, *::after {
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        min-height: 100vh;
        margin: 0;
        font-family: var(--font);
        line-height: 1.6;
        background: radial-gradient(circle at top, rgba(255, 255, 255, 0.08), transparent 28%),
                    linear-gradient(180deg, #0b1226 0%, #060b15 100%);
        color: var(--text);
    }

    .brand {
        display: inline-flex;
        align-items: center;
        gap: 18px;
        color: #fff;
        font-weight: 800;
        letter-spacing: 0.01em;
        font-family: var(--font);
    }

    .brand-logo {
        width: 120px;
        height: 36px;
        max-width: 120px;
        max-height: 36px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.12);
        padding: 4px;
        object-fit: contain;
    }

    .brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1;
    }

    .brand-title {
        font-size: 1.15rem;
    }

    .brand-subtitle {
        font-size: 0.82rem;
        color: rgba(255, 255, 255, 0.78);
        font-weight: 500;
    }

    body, input, textarea, button, select, a, label, p, span, h1, h2, h3, h4, h5, h6 {
        font-family: var(--font);
    }

    a {
        color: inherit;
        text-decoration: none;
    }

    a:hover {
        opacity: 0.88;
    }

    .app-body {
        min-height: 100vh;
    }

    .site-header {
        position: sticky;
        top: 0;
        z-index: 40;
        background: rgba(6, 16, 29, 0.95);
        backdrop-filter: blur(14px);
        padding: 10px 18px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }

    .header-inner {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    }

    .header-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: flex-end;
    }

    .main-content {
        max-width: 1200px;
        margin: 28px auto 40px;
        padding: 0 20px;
    }

    .container-card {
        background: var(--surface);
        color: var(--text);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 30px;
        border: 1px solid rgba(15, 23, 42, 0.06);
    }

    .page-heading {
        margin: 0 0 18px;
        font-size: clamp(1.85rem, 2.2vw, 2.7rem);
        line-height: 1.05;
    }

    .section-note {
        color: var(--muted);
        margin-top: 10px;
        max-width: 760px;
    }

    .alert {
        border-radius: 18px;
        padding: 16px 20px;
        font-weight: 600;
        margin-bottom: 18px;
        border: 1px solid transparent;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
    }

    .alert-success {
        background: #effaf7;
        color: #0f5132;
        border-color: #83e8d0;
    }

    .alert-error {
        background: #fff1f2;
        color: #9f1239;
        border-color: #fda4af;
    }

    .btn-primary,
    .btn-secondary,
    button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border-radius: 999px;
        padding: 12px 20px;
        font-weight: 700;
        transition: transform 0.18s ease, box-shadow 0.18s ease, opacity 0.18s ease;
        cursor: pointer;
        border: none;
    }

    .btn-primary {
        background: var(--accent);
        color: #fff;
        box-shadow: 0 14px 35px rgba(229, 9, 20, 0.2);
    }

    .btn-secondary {
        background: #fff;
        color: var(--text);
        border: 1px solid rgba(15, 23, 42, 0.08);
    }

    .btn-danger {
        background: #e05555;
        color: #fff;
        box-shadow: 0 14px 35px rgba(224, 85, 85, 0.18);
    }

    .btn-primary:hover,
    .btn-secondary:hover,
    .btn-danger:hover,
    button:hover {
        transform: translateY(-1px);
        opacity: 0.96;
    }

    .button-group {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="number"],
    textarea,
    select {
        width: 100%;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 14px 16px;
        background: #fff;
        color: var(--text);
        transition: border-color 0.18s ease, box-shadow 0.18s ease;
    }

    input:focus,
    textarea:focus,
    select:focus {
        outline: none;
        border-color: rgba(229, 9, 20, 0.4);
        box-shadow: 0 0 0 4px rgba(229, 9, 20, 0.08);
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #0f1724;
        font-weight: 700;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .auth-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
        margin-top: 16px;
    }

    .film-detail {
        display: grid;
        grid-template-columns: minmax(0, 320px) minmax(0, 1fr);
        gap: 30px;
        align-items: start;
    }

    .film-poster {
        overflow: hidden;
        border-radius: 24px;
        background: #f8fafc;
        min-height: 430px;
    }

    .film-poster img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .film-meta {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .film-title {
        font-size: clamp(2rem, 3vw, 2.7rem);
        margin: 0;
    }

    .film-sub {
        color: var(--muted);
        margin-bottom: 12px;
    }

    .film-overview {
        line-height: 1.75;
        color: #334155;
        margin: 0;
    }

    .film-meta form {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: center;
    }

    .film-meta .film-meta-footer {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .films-grid,
    .partages-grid,
    .amis-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 22px;
    }

    .films-grid.single-film {
        grid-template-columns: 1fr;
        max-width: 400px;
        margin: 0 auto;
    }

    .film-card {
        background: var(--surface);
        border-radius: 22px;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        box-shadow: 0 18px 50px rgba(15, 23, 42, 0.08);
        transition: transform 0.18s ease, box-shadow 0.18s ease;
        min-height: 100%;
        display: flex;
        flex-direction: column;
    }

    .film-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 24px 70px rgba(15, 23, 42, 0.14);
    }

    .film-card img {
        width: 100%;
        height: 320px;
        object-fit: cover;
        display: block;
    }

    .film-card .meta {
        padding: 18px;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .film-card .meta h3,
    .film-card .meta strong {
        margin: 0;
        font-size: 1rem;
    }

    .film-card .meta p {
        margin: 0;
        color: var(--muted);
        font-size: 0.95rem;
    }

    .search-toolbar {
        display: flex;
        flex-wrap: wrap;
        gap: 18px;
        align-items: flex-end;
        margin-bottom: 18px;
    }

    .category-section {
        margin-bottom: 24px;
    }

    .category-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 14px;
    }

    .category-title {
        margin: 0;
        font-size: 1rem;
        color: #fff;
    }

    .category-note,
    .slider-subtitle,
    .section-note {
        margin: 6px 0 0;
        color: rgba(255, 255, 255, 0.88);
        font-size: 0.95rem;
    }

    .category-actions {
        display: flex;
        gap: 10px;
    }

    .carousel-btn {
        width: 42px;
        height: 42px;
        border-radius: 999px;
        border: 2px solid rgba(255, 255, 255, 0.5);
        background: rgba(255, 255, 255, 0.8);
        color: #000000;
        cursor: pointer;
        font-size: 1.2rem;
        font-weight: bold;
        transition: all 0.18s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        text-shadow: none;
    }

    .carousel-btn:hover {
        background: rgba(255, 255, 255, 0.9);
        border-color: rgba(255, 255, 255, 0.7);
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
        color: #000000;
    }

    .category-pills {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        padding-bottom: 6px;
        margin-bottom: 18px;
    }

    .category-pill {
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.15);
        background: rgba(255, 255, 255, 0.08);
        color: #f8fafc;
        padding: 10px 16px;
        cursor: pointer;
        white-space: nowrap;
        font-size: 0.95rem;
        font-weight: 600;
        transition: background 0.18s ease, border-color 0.18s ease, color 0.18s ease;
    }

    .category-pill.active {
        background: var(--accent);
        border-color: var(--accent);
        color: #fff;
    }

    .category-results {
        margin-bottom: 24px;
    }

    .category-results-header h3 {
        color: #fff;
        margin: 0 0 10px;
        font-size: 1.15rem;
    }

    .category-shelf {
        display: flex;
        gap: 18px;
        overflow-x: auto;
        padding-bottom: 12px;
    }

    .category-card {
        background: var(--surface);
        border-radius: 22px;
        min-width: 220px;
        width: 220px;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        flex-shrink: 0;
    }

    .category-card img {
        width: 100%;
        height: 330px;
        object-fit: cover;
        display: block;
    }

    .category-card-meta {
        padding: 16px;
    }

    .category-card-meta strong {
        display: block;
        margin-bottom: 8px;
        font-size: 1rem;
    }

    .category-card-meta span {
        color: var(--muted);
        font-size: 0.95rem;
    }

    .home-upcoming-section {
        margin-top: 24px;
    }

    .upcoming-slider-card {
        border-radius: 24px;
        background: #fff;
        overflow: hidden;
        box-shadow: 0 28px 75px rgba(15, 23, 42, 0.15);
    }

    .upcoming-slider-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        padding: 22px 24px 12px;
    }

    .upcoming-slider-header strong {
        display: block;
        font-size: 1.15rem;
        margin-top: 10px;
        color: var(--text);
    }

    .upcoming-slider-card .slider-subtitle {
        margin-top: 10px;
        color: #64748b;
    }

    .upcoming-slider-track {
        display: flex;
        gap: 16px;
        overflow-x: auto;
        padding: 18px 22px 22px;
    }

    .upcoming-slide {
        min-width: 220px;
        max-width: 220px;
        background: #f8fafc;
        border-radius: 22px;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        flex-shrink: 0;
    }

    .upcoming-slide img {
        width: 100%;
        height: 320px;
        object-fit: cover;
        display: block;
    }

    .upcoming-slide-meta {
        padding: 16px;
    }

    .upcoming-slide-meta strong {
        display: block;
        margin-bottom: 8px;
        font-size: 1rem;
    }

    .upcoming-slide-meta span {
        color: var(--muted);
        font-size: 0.9rem;
    }

    .slider-controls {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-top: 8px;
    }

    .upcoming-slide img {
        width: 100%;
        display: block;
        object-fit: cover;
    }

    .upcoming-slide-meta {
        padding: 16px;
        background: #fff;
    }

    .upcoming-hero-meta .pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(229, 9, 20, 0.1);
        color: var(--accent);
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .upcoming-hero-meta strong {
        display: block;
        margin: 0 0 6px;
        font-size: 1.1rem;
        color: var(--text);
    }

    .upcoming-hero-meta span {
        color: var(--muted);
        font-size: 0.95rem;
    }

    .upcoming-list {
        margin-top: 16px;
        display: grid;
        gap: 10px;
    }

    .upcoming-list-item {
        display: block;
        padding: 14px 16px;
        border-radius: 18px;
        background: #f8fafc;
        color: var(--text);
        text-decoration: none;
        border: 1px solid rgba(15, 23, 42, 0.08);
    }

    .upcoming-list-item strong {
        display: block;
        margin-top: 6px;
    }

    .search-input-wrap {
        position: relative;
        flex: 1 1 420px;
        min-width: 240px;
    }

    .search-input {
        width: 100%;
        padding: 16px 18px;
        border-radius: 20px;
        border: 1px solid rgba(15, 23, 42, 0.1);
        background: #f8fafc;
        color: #0f1724;
        font-size: 1rem;
    }

    .autocomplete-results {
        position: absolute;
        left: 0;
        right: 0;
        top: calc(100% + 12px);
        background: #fff;
        border: 1px solid rgba(15, 23, 42, 0.08);
        border-radius: 20px;
        box-shadow: 0 24px 75px rgba(15, 23, 42, 0.14);
        overflow: hidden;
        max-height: 340px;
        z-index: 30;
    }

    .suggestion-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        border-bottom: 1px solid #f1f5f9;
        text-decoration: none;
        color: inherit;
        transition: background 0.18s ease;
        cursor: pointer;
    }

    .suggestion-item:last-child {
        border-bottom: none;
    }

    .suggestion-item:hover {
        background: #f8fafc;
    }

    .suggestion-item img {
        width: 48px;
        height: 72px;
        object-fit: cover;
        border-radius: 14px;
        flex-shrink: 0;
    }

    .suggestion-item div {
        min-width: 0;
    }

    .suggestion-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 12px;
    }

    .selected-movie {
        border-radius: 22px;
        border: 1px solid rgba(15, 23, 42, 0.08);
        background: #f8fafc;
        padding: 16px;
        margin-top: 16px;
    }

    .poster-placeholder {
        width: 100%;
        min-height: 420px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 24px;
        background: #eff6ff;
        color: #475569;
    }

    .selected-movie img,
    .cast-card img {
        border-radius: 18px;
    }

    .empty-state {
        color: var(--muted);
        margin-top: 10px;
    }

    .profile-grid {
        display: grid;
        gap: 24px;
    }

    .profile-panel {
        max-width: 720px;
        margin: 0 auto;
    }

    .profile-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 14px;
    }

    .profile-avatar {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid rgba(229, 9, 20, 0.14);
        display: block;
        margin-bottom: 14px;
    }

    .film-detail {
        display: grid;
        grid-template-columns: minmax(0, 320px) minmax(0, 1fr);
        gap: 32px;
        align-items: start;
    }

    .film-meta {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .film-meta .film-info {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        color: var(--muted);
    }

    .film-meta .film-detail-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: center;
    }

    .trailer-card {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
        border-radius: 22px;
    }

    .trailer-card iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    .cast-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(110px, 1fr));
        gap: 16px;
        padding-top: 8px;
    }

    .cast-card {
        text-align: center;
    }

    .cast-card strong {
        display: block;
        margin-top: 12px;
        font-size: 0.95rem;
    }

    .cast-card span {
        color: var(--muted);
        font-size: 0.92rem;
    }

    @media (max-width: 980px) {
        .header-inner,
        .film-detail,
        .search-toolbar,
        .profile-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 720px) {
        .site-header {
            padding: 16px 14px;
        }
        .main-content {
            margin: 20px auto 32px;
            padding: 0 16px;
        }
        .container-card {
            padding: 24px;
        }
        .film-card img {
            height: 260px;
        }
    }
</style>
