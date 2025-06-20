<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', config('app.name'))</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

  <style>
    :root {
      --bg-color: #f1f5f9;
      --text-color: #1e293b;
      --card-bg: #ffffff;
      --border-color: #e2e8f0;
      --footer-color: #64748b;
      --primary-color: #6366f1;

      --table-bg-color: #ffffff;
      --table-text-color: #1e293b;

      --input-bg: #ffffff;
      --input-text: #1e293b;
      --input-border: #cbd5e1;
    }

    .dark {
      --bg-color: #0f172a;
      --text-color: #f1f5f9;
      --card-bg: #1e293b;
      --border-color: #334155;
      --footer-color: #94a3b8;
      --primary-color: #6366f1;

      --table-bg-color: #1e293b;
      --table-text-color: #f1f5f9;

      --input-bg: #1e293b;
      --input-text: #f1f5f9;
      --input-border: #475569;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    html, body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg-color);
      color: var(--text-color);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      transition: background-color 0.3s, color 0.3s;
    }

    header {
      background-color: var(--card-bg);
      padding: 1rem 2rem;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header h1 {
      font-size: 1.25rem;
      font-weight: 800;
      color: var(--primary-color);
    }

    nav a,
    nav form button {
      margin-left: 1rem;
      text-decoration: none;
      font-weight: 600;
      color: var(--text-color);
      transition: all 0.3s ease;
    }

    nav a:hover,
    nav form button:hover {
      transform: scale(1.05);
      color: var(--primary-color);
      text-decoration: underline;
    }

    .theme-toggle {
      font-size: 1.25rem;
      background: none;
      border: none;
      cursor: pointer;
      color: var(--text-color);
      transition: transform 0.3s;
    }

    .theme-toggle:hover {
      transform: scale(1.2);
    }

    main {
      flex: 1;
      padding: 2rem;
      max-width: 1200px;
      margin: 0 auto;
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

    .grid-buttons {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 2rem;
      margin-top: 3rem;
    }

    .action-card {
      background: var(--card-bg);
      border-radius: 12px;
      padding: 2rem;
      text-align: center;
      text-decoration: none;
      font-weight: 600;
      color: var(--text-color);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
      transition: transform 0.2s, box-shadow 0.2s, background 0.3s, border 0.2s;
      border: 2px solid transparent;
      font-size: 1.2rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 0.75rem;
      height: 200px;
    }

    .action-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
      border-color: var(--primary-color);
    }

    table {
      background: var(--table-bg-color);
      color: var(--table-text-color);
      width: 100%;
      border-radius: 0.5rem;
      overflow: hidden;
    }

    th, td {
      padding: 0.75rem 1rem;
    }

    th {
      font-weight: 600;
      background: var(--border-color);
    }

    tr:nth-child(even) {
      background: rgba(0, 0, 0, 0.025);
    }

    .btn-edit, .btn-delete {
      display: block;
      padding: 0.25rem 0.5rem;
      border-radius: 6px;
      font-weight: bold;
      text-align: center;
      transition: all 0.3s;
    }

    .btn-edit {
      background-color: var(--primary-color);
      color: white;
      margin-bottom: 4px;
    }

    .btn-edit:hover {
      background-color: #4f46e5;
    }

    .btn-delete {
      background-color: #dc2626;
      color: white;
    }

    .btn-delete:hover {
      background-color: #b91c1c;
    }

    img.icon {
      width: 40px;
      height: 40px;
      object-fit: contain;
    }

    .input {
      width: 100%;
      padding: 0.5rem 0.75rem;
      border-radius: 6px;
      border: 1px solid var(--input-border);
      background: var(--input-bg);
      color: var(--input-text);
      transition: border 0.3s, background 0.3s, color 0.3s;
    }

    .input:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 1px var(--primary-color);
    }

    .menu-title {
      font-size: 2.75rem;
      font-weight: 800;
      color: var(--primary-color);
      text-align: center;
      margin-bottom: 1rem;
      transition: all 0.3s;
    }

    .menu-subtitle {
      text-align: center;
      font-size: 1.125rem;
      color: var(--text-color);
      opacity: 0.8;
      margin-bottom: 2rem;
    }

    @media (max-width: 768px) {
      .grid-buttons {
        grid-template-columns: 1fr;
      }
      .action-card {
        height: auto;
        padding: 1.5rem;
      }
    }
  </style>

  <script>
    if (
      localStorage.theme === 'dark' ||
      (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }

    function toggleTheme() {
      if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        localStorage.theme = 'light';
      } else {
        document.documentElement.classList.add('dark');
        localStorage.theme = 'dark';
      }
    }
  </script>
</head>

<body>
  <header>
    <h1>Laravel - Pedro Muci</h1>
    <nav class="flex items-center">
      <a href="{{ route('menu') }}">🏠 Menu</a>
      <a href="{{ route('competicoes.index') }}">🏆 Competições</a>
      <a href="{{ route('times.index') }}">⚽ Times</a>
      <a href="{{ route('simulacoes.index') }}">⚔️ Duelos</a>

      <button onclick="toggleTheme()" class="theme-toggle ms-4" title="Alternar tema">🌓</button>

      <form method="POST" action="{{ route('logout') }}" class="inline">
        @csrf
        <button type="submit" class="ms-4">🚪 Sair</button>
      </form>
    </nav>
  </header>

  <main>
    @yield('content')
  </main>

  <footer>
    © {{ date('Y') }} Laravel - Pedro Muci
  </footer>
</body>
</html>
