<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'Web API') }}</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-color: #f1f5f9;
      --text-color: #1e293b;
      --card-bg: white;
      --border-color: #e2e8f0;
      --footer-color: #94a3b8;
      --table-header-bg: #f8fafc;
      --primary-color: #2563eb;
      --success-color: #10b981;
      --warning-color: #facc15;
      --danger-color: #ef4444;
    }
    body.dark {
      --bg-color: #0f172a;
      --text-color: #f1f5f9;
      --card-bg: #1e293b;
      --border-color: #334155;
      --footer-color: #64748b;
      --table-header-bg: #1e293b;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--bg-color);
      color: var(--text-color);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      transition: background 0.3s, color 0.3s;
    }

    header {
      background: var(--card-bg);
      padding: 1.5rem 2rem;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    header a {
      font-size: 2rem;
      font-weight: 800;
      color: var(--primary-color);
      text-decoration: none;
    }
    .theme-toggle {
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: var(--text-color);
    }

    main {
      flex: 1;
      padding: 2rem;
      /* Aumenta o espaço horizontal disponível */
      max-width: 1400px; /* ← ALTERE ESSE VALOR para ajustar largura máxima da área principal */
      margin: auto;
      width: 100%;
    }

    footer {
      text-align: center;
      padding: 1rem;
      font-size: 0.875rem;
      color: var(--footer-color);
      background: var(--card-bg);
      border-top: 1px solid var(--border-color);
    }

    .header-with-icon {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 2rem;
    }
    .header-with-icon img {
      height: 40px;
      width: auto;
    }

    .grid-buttons {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 2rem;
      margin-top: 3rem;
    }
    .action-card {
      background: var(--card-bg);
      border-radius: 12px;
      padding: 2.5rem;
      text-align: center;
      text-decoration: none;
      font-weight: 600;
      color: var(--text-color);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
      transition: transform 0.2s, box-shadow 0.2s, background 0.3s;
      border: 2px solid transparent;
      font-size: 1.2rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 1rem;
      height: 200px;
    }
    .action-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
      border-color: var(--primary-color);
    }
    .action-card img {
      height: 64px;
      width: auto;
      object-fit: contain;
    }

    h1 {
      font-size: 2rem;
      font-weight: 700;
      text-align: center;
      margin-top: 3rem;
    }
    p.subtitle {
      text-align: center;
      color: #64748b;
      font-size: 1rem;
      margin-top: 1rem;
    }

    .btn-primary {
      background: var(--primary-color);
      color: #fff;
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      margin-bottom: 1.5rem;
    }
    .btn-submit {
      background: var(--success-color);
      color: #fff;
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      margin-top: 1rem;
    }
    .btn-edit {
      background: var(--warning-color);
      color: #000;
      padding: 0.4rem 0.75rem;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      margin-right: 0.3rem;
    }
    .btn-delete {
      background: var(--danger-color);
      color: #fff;
      padding: 0.4rem 0.75rem;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
    }

    .form-hidden {
      display: none;
      margin-bottom: 2rem;
      background: var(--card-bg);
      padding: 1.5rem;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    .form-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 1.5rem;
    }
    .form-group label {
      display: block;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }
    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: 0.5rem;
      border: 1px solid var(--border-color);
      border-radius: 6px;
      background: var(--bg-color);
      color: var(--text-color);
    }

    .usuarios-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
      background: var(--card-bg);
      border-radius: 12px;
      overflow: hidden;
    }
    .usuarios-table th,
    .usuarios-table td {
      padding: 0.75rem 1rem;
      text-align: left;
      border-bottom: 1px solid var(--border-color);
      vertical-align: top;
      word-break: break-word;
    }
    .usuarios-table th {
      background: var(--table-header-bg);
      white-space: nowrap;
    }

    @media (max-width: 768px) {
      .grid-buttons {
        grid-template-columns: 1fr;
      }
      .action-card {
        padding: 2rem;
        height: auto;
      }
    }
  </style>
</head>
<body>
  <header>
    <a href="{{ route('menu') }}">Web API</a>
    <button class="theme-toggle" id="theme-toggle" title="Alternar tema">🌓</button>
  </header>

  <main>
    @yield('content')
  </main>

  <footer>
    Sistema desenvolvido com Laravel {{ Illuminate\Foundation\Application::VERSION }}
  </footer>

  <script>
    const btn = document.getElementById('theme-toggle');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const saved = localStorage.getItem('theme');
    if (saved==='dark' || (!saved && prefersDark)) {
      document.body.classList.add('dark');
    }
    btn.addEventListener('click', ()=>{
      document.body.classList.toggle('dark');
      localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
    });
  </script>

  @stack('scripts')
</body>
</html>
