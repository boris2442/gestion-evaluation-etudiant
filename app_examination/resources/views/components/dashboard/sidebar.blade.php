<aside id="sidebar" class="min-w-64 header-home
           bg-blue-600 text-white shadow-lg min-h-screen fixed z-40 left-0 top-0
           transform -translate-x-full md:translate-x-0 transition-transform duration-300
           md:fixed md:block block md:min-w-64
           dark:bg-neutral-900 dark:text-neutral-200" style="width: 16rem;">

    <!-- Titre entreprise -->
    <div class="h-16 flex items-center justify-center uppercase font-bold text-xl 
                text-white dark:text-neutral-100 tracking-wide border-b border-blue-700 dark:border-neutral-700">
        GODFASHION
    </div>

    <!-- Navigation -->
    <nav class="mt-6 px-4 space-y-2">

        <!-- Exemple lien -->
        <a href=""
            class="flex items-center py-2.5 px-4 rounded-lg transition duration-200
                   hover:bg-blue-700 hover:text-white
                   dark:hover:bg-neutral-800 dark:hover:text-white
                   ">
            <i class="fas fa-home mr-2"></i> Accueil
        </a>
        {{-- @auth --}}
     
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center py-2.5 px-4 rounded-lg transition duration-200
                   hover:bg-blue-700 hover:text-white
                   dark:hover:bg-neutral-800 dark:hover:text-white
                 'bg-blue-700 text-white dark:bg-neutral-800'  'text-gray-200 dark:text-neutral-300' }}">
            <i class="fas fa-chart-line mr-2"></i> Dashboard
        </a>
        {{-- @endauth --}}
        <a href=""
            class="flex items-center py-2.5 px-4 rounded-lg transition duration-200
                   hover:bg-blue-700 hover:text-white
                   dark:hover:bg-neutral-800 dark:hover:text-white
                  'bg-blue-700 text-white dark:bg-neutral-800' : 'text-gray-200 dark:text-neutral-300' }}">
            <i class="fas fa-users mr-2"></i> Utilisateurs
        </a>

        <a href=" " 
            class="flex items-center py-2.5 px-4 rounded-lg transition duration-200
                   hover:bg-blue-700 hover:text-white
                   dark:hover:bg-neutral-800 dark:hover:text-white
           'bg-blue-700 text-white dark:bg-neutral-800' : 'text-gray-200 dark:text-neutral-300' }}">
            <i class="fas fa-book mr-2"></i> Clients
        </a>

        <a href=" "  
            class="flex items-center py-2.5 px-4 rounded-lg transition duration-200
                   hover:bg-blue-700 hover:text-white
                   dark:hover:bg-neutral-800 dark:hover:text-white
       'bg-blue-700 text-white dark:bg-neutral-800' : 'text-gray-200 dark:text-neutral-300' }}">
            <i class="fas fa-layer-group mr-2"></i> Commandes
        </a>
        <a href=""
            class="flex items-center py-2.5 px-4 rounded-lg transition duration-200
                   hover:bg-blue-700 hover:text-white
                   dark:hover:bg-neutral-800 dark:hover:text-white
            'bg-blue-700 text-white dark:bg-neutral-800' : 'text-gray-200 dark:text-neutral-300' "      >
            <i class="fas fa-money-check-alt mr-2"></i> Paiements
        </a>
        <a href=""
            class="flex items-center py-2.5 px-4 rounded-lg transition duration-200
                   hover:bg-blue-700 hover:text-white
                   dark:hover:bg-neutral-800 dark:hover:text-white
              ">
            <i class="fas fa-money-bill mr-2"></i> Depenses
        </a>
       
        <!-- Déconnexion -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full text-left py-2.5 px-4 rounded-lg transition duration-200
                       bg-red-500 hover:bg-red-600 text-white dark:text-neutral-200 dark:hover:bg-red-700">
                <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
            </button>
        </form>
    </nav>
</aside>

<!-- Overlay mobile -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-40 z-30 hidden md:hidden" onclick="toggleSidebar()">
</div>
