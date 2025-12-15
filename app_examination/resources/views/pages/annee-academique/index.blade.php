@extends('layouts.admin.layout-admin')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-neutral-900 py-10 px-4 ml-0 md:ml-64 mt-16">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Gestion des Années Académiques</h1>
        
        <a href="{{ route('annee-academiques.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
            ➕ Ajouter une Année
        </a>
    </div>

    {{-- Affichage des messages Flash (Succès ou Erreur) --}}
    @if (session('success'))
        <div id="flash-message" class="bg-green-100 dark:bg-green-900 border-l-4 border-green-500 dark:border-green-600 text-green-700 dark:text-green-200 p-4 mb-4 rounded" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if (session('error'))
        <div id="flash-message" class="bg-red-100 dark:bg-red-900 border-l-4 border-red-500 dark:border-red-600 text-red-700 dark:text-red-200 p-4 mb-4 rounded" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="bg-white dark:bg-neutral-800 shadow-xl rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-100 dark:bg-neutral-700 text-gray-600 dark:text-gray-300 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Libellé</th>
                    <th class="py-3 px-6 text-left">Période</th>
                    <th class="py-3 px-6 text-center">Statut</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 dark:text-gray-300 text-sm font-light">
                @foreach ($annees as $annee)
                    <tr class="border-b border-gray-200 dark:border-neutral-600 hover:bg-gray-50 dark:hover:bg-neutral-700 {{ $annee->statut ? 'bg-yellow-50 dark:bg-yellow-900/30 dark:hover:bg-yellow-900/40 font-semibold' : '' }}">
                        
                        {{-- Libellé --}}
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="font-medium dark:text-gray-200">{{ $annee->libelle }}</span>
                                @if ($annee->statut)
                                    <span class="ml-2 text-xs bg-yellow-600 dark:bg-yellow-700 text-white px-2 py-0.5 rounded-full">Active</span>
                                @endif
                            </div>
                        </td>
                        
                        {{-- Période --}}
                        <td class="py-3 px-6 text-left dark:text-gray-300">
                            Du {{ $annee->date_debut->format('d/m/Y') }} au {{ $annee->date_fin->format('d/m/Y') }}
                        </td>
                        
                        {{-- Statut (Bouton d'activation) --}}
                        <td class="py-3 px-6 text-center">
                            <form action="{{ route('annee-academiques.toggle-statut', $annee) }}" method="POST">
                                @csrf
                                @method('PUT') 
                                <button type="submit" 
                                        class="text-white font-bold py-1 px-3 rounded-lg text-xs transition duration-300
                                               {{ $annee->statut ? 'bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700' : 'bg-green-500 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700' }}"
                                        title="{{ $annee->statut ? 'Désactiver cette année' : 'Activer cette année (désactivera les autres)' }}">
                                    {{ $annee->statut ? 'Désactiver' : 'Activer' }}
                                </button>
                            </form>
                        </td>
                        
                        {{-- Actions (Modifier et Supprimer) --}}
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-2">
                                {{-- Modifier --}}
                                <a href="{{ route('annee-academiques.edit', $annee) }}" 
                                   class="w-4 mr-2 transform hover:text-purple-500 dark:hover:text-purple-400 hover:scale-110" 
                                   title="Modifier">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                                
                                {{-- Supprimer --}}
                                <form action="{{ route('annee-academiques.destroy', $annee) }}" method="POST" 
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette année académique ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-4 mr-2 transform hover:text-red-500 dark:hover:text-red-400 hover:scale-110" 
                                            title="Supprimer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        {{-- Message si aucune année n'est trouvée --}}
        @if ($annees->isEmpty())
            <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                Aucune année académique n'a été trouvée. Veuillez en ajouter une.
            </div>
        @endif
        
        {{-- Pagination --}}
        {{-- @if($annees->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-neutral-600 bg-white dark:bg-neutral-800">
                {{ $annees->links() }}
            </div>
        @endif --}}
    </div>
</div>

<style>
    /* Améliorations pour le dark mode */
    .dark .text-gray-600 {
        color: #d1d5db; /* gray-300 */
    }
    
    .dark .font-light {
        color: #e5e7eb; /* gray-200 */
    }
    
    .dark .hover\:bg-gray-50:hover {
        background-color: #374151; /* neutral-700 */
    }
    
    /* Pagination dark mode */
    .dark .pagination .page-link {
        color: #d1d5db;
        background-color: #374151;
        border-color: #4b5563;
    }
    
    .dark .pagination .page-link:hover {
        background-color: #4b5563;
        border-color: #6b7280;
    }
    
    .dark .pagination .active .page-link {
        background-color: #3b82f6; /* blue-500 */
        border-color: #3b82f6;
    }
    
    .dark .pagination .disabled .page-link {
        color: #9ca3af;
        background-color: #374151;
        border-color: #4b5563;
    }
</style>

<script>
    // Auto-hide flash messages after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const flashMessages = document.querySelectorAll('#flash-message');
        flashMessages.forEach(message => {
            setTimeout(() => {
                message.style.opacity = '0';
                message.style.transition = 'opacity 0.5s';
                setTimeout(() => message.remove(), 500);
            }, 5000);
        });
    });
</script>
@endsection
