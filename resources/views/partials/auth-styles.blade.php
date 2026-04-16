<style>
    *, *::before, *::after {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        min-height: 100vh;
        font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        background: radial-gradient(circle at top, rgba(255, 255, 255, 0.08), transparent 28%),
                    linear-gradient(135deg, #0b1226 0%, #10213c 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 24px;
        color: #0f1724;
    }

    .container {
        width: 100%;
        max-width: 520px;
        background: #ffffff;
        border-radius: 28px;
        padding: 34px;
        box-shadow: 0 24px 80px rgba(2, 6, 23, 0.18);
        border: 1px solid rgba(15, 23, 42, 0.08);
    }

    h1 {
        margin: 0 0 18px;
        font-size: clamp(1.75rem, 3vw, 2.3rem);
        text-align: center;
        color: #111827;
    }

    .form-group {
        margin-bottom: 18px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 700;
        color: #0f1724;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 14px 16px;
        border-radius: 16px;
        border: 1px solid rgba(15, 23, 42, 0.12);
        background: #f8fafc;
        color: #0f1724;
        transition: border-color 0.18s ease, box-shadow 0.18s ease;
    }

    input:focus {
        outline: none;
        border-color: rgba(229, 9, 20, 0.35);
        box-shadow: 0 0 0 4px rgba(229, 9, 20, 0.08);
    }

    .auth-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
        margin-top: 14px;
    }

    .btn-primary,
    .btn-secondary,
    button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border-radius: 999px;
        padding: 14px 20px;
        font-weight: 700;
        border: none;
        transition: transform 0.18s ease, opacity 0.18s ease;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-primary {
        background: #e50914;
        color: #fff;
    }

    .btn-secondary {
        background: #f8fafc;
        color: #111827;
        border: 1px solid rgba(15, 23, 42, 0.08);
    }

    .btn-primary:hover,
    .btn-secondary:hover,
    button:hover {
        transform: translateY(-1px);
        opacity: 0.95;
    }

    .link {
        text-align: center;
        margin-top: 16px;
        color: #475569;
    }

    .link a {
        color: #0f1724;
        font-weight: 700;
    }

    .error {
        color: #b91c1c;
        margin-top: 8px;
        font-size: 0.95rem;
    }

    @media (max-width: 520px) {
        body {
            padding: 18px;
        }

        .container {
            padding: 28px;
        }

        .auth-actions {
            flex-direction: column;
        }
    }
</style>
