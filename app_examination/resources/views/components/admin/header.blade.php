<!-- Top bar -->
<!-- Top bar -->
<header class="h-16 flex items-center fixed top-0 right-0 w-full px-6 z-10 
           bg-blue-600 text-white shadow-md transition-colors duration-300
           dark:bg-neutral-900 dark:text-neutral-100">

    <!-- Bouton hamburger visible uniquement sur mobile -->
    <button class="md:hidden p-2 focus:outline-none mr-2 text-white dark:text-neutral-200" onclick="toggleSidebar()">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <div class="flex-1">
        <!-- Espace pour titres, breadcrumb, etc. -->
    </div>

    <div class="flex items-center space-x-4">



        <!-- Alerte caisse uniquement sur le dashboard -->
        <!-- Icône alerte caisse dans le header -->

        <!-- Alerts dropdown (mettre dans le header) -->
        @if(Route::currentRouteName() === 'admin.dashboard' && $alerteCaisse)
        <div x-data="{ openAlerts: false }" class="relative">
            <!-- Bouton principal : cloche + badge nombre d'alertes -->
            <button @click="openAlerts = !openAlerts" class="relative p-2 focus:outline-none">
                <i class="fas fa-bell text-white text-xl"></i>

                @if(isset($alertsCount) && $alertsCount > 0)
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold px-1 rounded-full">
                    {{ $alertsCount }}
                </span>
                @endif
            </button>

            <!-- Dropdown -->
            <div x-show="openAlerts" x-cloak x-transition:enter="transform transition ease-out duration-300"
                x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transform transition ease-in duration-300"
                x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0"
                @click.away="openAlerts = false"
                class="fixed top-20 right-4 w-96 bg-white dark:bg-neutral-800 rounded-lg shadow-lg z-50 overflow-hidden">
                <div class="px-4 py-3 border-b dark:border-neutral-700 flex justify-between items-center">
                    <span class="font-semibold text-sm text-gray-700 dark:text-neutral-200">Alertes</span>
                    <span class="text-xs text-gray-500 dark:text-neutral-400">{{ $alertsCount }} nouvelles</span>
                </div>

                <div class="max-h-72 overflow-y-auto">
                    @if(!empty($alerts) && count($alerts) > 0)
                    @foreach($alerts as $alert)
                    <a href="{{ $alert['link'] ?? '#' }}"
                        class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-neutral-700 transition flex gap-3 items-start">
                        <div class="flex-shrink-0">
                            <i
                                class="{{ $alert['icon'] }} text-lg 
                                            {{ $alert['severity'] === 'critical' ? 'text-red-500' : ($alert['severity'] === 'warning' ? 'text-yellow-500' : 'text-blue-500') }}">
                            </i>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm text-gray-800 dark:text-neutral-100 font-medium">
                                {{ $alert['message'] }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-neutral-400 mt-1">
                                Type : {{ ucfirst($alert['type']) }}
                            </div>
                        </div>
                    </a>
                    @endforeach
                    @else
                    <div class="px-4 py-4 text-sm text-gray-500 dark:text-neutral-400">Aucune alerte</div>
                    @endif
                </div>

                <div class="px-4 py-2 border-t text-center dark:border-neutral-700">
                    <a href="{{ route('admin.dashboard') }}" class="text-sm text-blue-600 hover:underline">
                        Voir le tableau de bord
                    </a>
                </div>
            </div>
        </div>
        @endif


        <!-- Icône notification générique (toujours visible si nécessaire) -->




        <!-- Toggle mode sombre -->

        @include('components.dark.dark')
        <!-- Nom utilisateur -->


        <span class="text-[12px] font-bold text-white dark:text-neutral-200">
            Welcome, {{ auth()->user()->name }}
        </span>

        <!-- Déconnexion -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block w-full text-[12px] text-left py-1 md:py-2.5 px-4 rounded transition duration-200 
                       bg-red-500 hover:bg-red-600 text-white dark:text-gray-200">
                <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
            </button>
        </form>
    </div>
</header>
<!-- Script pour le toggle mode sombre -->

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const isOpen = sidebar.classList.contains('translate-x-0');

        if (isOpen) {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        } else {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            overlay.classList.remove('hidden');
        }
    }
</script>
