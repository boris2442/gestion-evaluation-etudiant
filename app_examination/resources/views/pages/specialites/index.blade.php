@extends('layouts.admin.layout-admin') 

@section('content')
<div class="container mx-auto px-4 py-8 ml-64"  >
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Gestion des Spécialités</h1>
        
        <a href="{{ route('specialites.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
            ➕ Ajouter une Spécialité
        </a>
    </div>

    {{-- Affichage des messages Flash (Succès ou Erreur) --}}
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 dark:bg-green-800 dark:border-green-600 dark:text-green-50" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 dark:bg-red-800 dark:border-red-600 dark:text-red-50" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden">
        <table class="w-full leading-normal">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Nom de la Spécialité</th>
                    <th class="py-3 px-6 text-left">Code Unique</th>
                    <th class="py-3 px-6 text-left">Description</th>
                    <th class="py-3 px-6 text-center">Modules rattachés</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 dark:text-gray-300 text-sm font-light">
                @forelse ($specialites as $specialite)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                        
                        {{-- Nom de la Spécialité --}}
                        <td class="py-3 px-6 text-left whitespace-nowrap font-medium">
                            {{ $specialite->nom_specialite }}
                        </td>
                        
                        {{-- Code Unique --}}
                        <td class="py-3 px-6 text-left">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">
                                {{ $specialite->code_unique }}
                            </span>
                        </td>
                        
                        {{-- Description --}}
                        <td class="py-3 px-6 text-left">
                            {{ Str::limit($specialite->description, 50) }}
                        </td>

                        {{-- Modules rattachés (Placez le count ici après avoir créé le modèle Module) --}}
                        <td class="py-3 px-6 text-center">
                            {{-- $specialite->modules_count ?? 0 --}} 0
                        </td>
                        
                        {{-- Actions --}}
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-2">
                                {{-- Modifier --}}
                                <a href="{{ route('specialites.edit', $specialite) }}" 
                                   class="text-blue-500 hover:text-blue-700 transform hover:scale-110" title="Modifier">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                                
                                {{-- Supprimer --}}
                                <form action="{{ route('specialites.destroy', $specialite) }}" method="POST" onsubmit="return confirm('ATTENTION : Êtes-vous sûr de vouloir supprimer cette spécialité ? Cela peut être impossible si des modules y sont rattachés.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transform hover:scale-110" title="Supprimer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-500 dark:text-gray-400">
                            Aucune spécialité n'a été trouvée. Veuillez en <a href="{{ route('specialites.create') }}" class="text-blue-600 hover:underline">ajouter une</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
