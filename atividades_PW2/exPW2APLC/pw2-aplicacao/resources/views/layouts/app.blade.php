<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', config('app.name'))</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
  
    .lament-footer {
      background-color: #1f2937; 
      color: white;
      padding: 1rem 0;
      margin-top: auto; 
    }
   
    .nav-container {
      background-color: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(0, 0, 0, 0.1);
      border-radius: 0.75rem;
      padding: 0.75rem 1.5rem;
    }
    .dark .nav-container {
      background-color: rgba(31, 41, 55, 0.5);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }
  </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 font-sans antialiased min-h-screen flex flex-col">


  <header class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
      <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
        Laravel - Pedro Muci
      </h1>
      <nav class="nav-container space-x-6"> 
        <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 font-medium px-2 py-1">Dashboard</a>
        <a href="{{ route('clientes.index') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 font-medium px-2 py-1">Clientes</a>
        <a href="{{ route('pedidos.index') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 font-medium px-2 py-1">Pedidos</a>
        <form method="POST" action="{{ route('logout') }}" class="inline">
          @csrf
          <button type="submit" class="text-red-600 hover:text-red-800 font-semibold px-2 py-1">Sair</button>
        </form>
      </nav>
    </div>
  </header>


  <main class="flex-grow container max-w-7xl mx-auto px-4 py-6">
    @yield('content')
  </main>

 
  <footer class="lament-footer w-full">
    <div class="max-w-7xl mx-auto px-4">
      <div class="text-center">
        ©Laravel - 2025
      </div>
    </div>
  </footer>

</body>
</html>