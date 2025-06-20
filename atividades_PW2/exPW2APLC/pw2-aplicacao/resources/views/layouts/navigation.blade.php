<nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      {{-- Logo --}}
      <div class="flex items-center space-x-4">
        <a href="{{ route('dashboard') }}" class="text-lg font-bold text-gray-900 dark:text-white">Pedro Muci</a>
      </div>

      {{-- Links de navegação --}}
      <div class="flex items-center space-x-6">
        <a href="{{ route('dashboard') }}" class="text-sm font-medium hover:text-indigo-600 dark:hover:text-indigo-400 {{ request()->routeIs('dashboard') ? 'underline' : '' }}">Dashboard</a>
        <a href="{{ route('competicoes.index') }}" class="text-sm font-medium hover:text-indigo-600 dark:hover:text-indigo-400">Competições</a>
        <a href="{{ route('times.index') }}" class="text-sm font-medium hover:text-indigo-600 dark:hover:text-indigo-400">Times</a>
        <a href="{{ route('simulacoes.index') }}" class="text-sm font-medium hover:text-indigo-600 dark:hover:text-indigo-400">Simulações</a>

        {{-- Botão de logout --}}
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="text-sm font-medium text-red-600 hover:text-red-800 dark:hover:text-red-400">Sair</button>
        </form>
      </div>
    </div>
  </div>
</nav>
