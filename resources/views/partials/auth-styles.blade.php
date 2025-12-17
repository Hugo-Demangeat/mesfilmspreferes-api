<style>
    /* Shared auth / page container styles to match site */
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        color: #333;
    }
    .container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.18);
        padding: 36px 34px;
        max-width: 520px;
        width: 100%;
    }
    h1 { text-align:center; margin-bottom:18px; color:#222; }
    .form-group { margin-bottom:16px; }
    label { display:block; margin-bottom:6px; font-weight:600; color:#333; }
    input[type="text"], input[type="email"], input[type="password"] {
        width:100%; padding:12px; border:1px solid #e0e0e0; border-radius:8px; font-size:14px;
    }
    .auth-actions { display:flex; gap:10px; justify-content:center; align-items:center; margin-top:6px; }
    .btn-primary {
        background:#667eea; color:white; padding:12px 18px; border-radius:8px; border:none; cursor:pointer; font-weight:700; display:inline-flex; gap:8px; align-items:center; text-decoration:none;
    }
    .btn-primary .icon{font-size:16px}
    .btn-secondary {
        background:#f5f7ff; color:#5568d3; border:1px solid #dbe4ff; padding:11px 16px; border-radius:8px; text-decoration:none; font-weight:700; display:inline-flex; gap:8px; align-items:center;
    }
    .btn-secondary:hover, .btn-primary:hover { transform:translateY(-2px); }
    .link { text-align:center; margin-top:12px; }
    .error { color:#d32f2f; margin-top:6px; font-size:13px }
    @media(max-width:480px){ .container{padding:20px} .auth-actions{flex-direction:column} }
</style>
