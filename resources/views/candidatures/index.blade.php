@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-file-signature text-green-600 text-3xl mr-3"></i>
                Mes candidatures
            </h2>
            <p class="text-gray-500 text-sm mt-1">Suivez l'état de vos candidatures aux stages</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <a href="{{ route('stages.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center text-sm">
                <i class="fas fa-search mr-2"></i> Voir les stages
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg mb-6 flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg mb-6 flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3"></i>
                <span>{{ session('error') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <!-- Statistiques rapides -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-blue-500">
            <p class="text-2xl font-bold text-blue-600">{{ $candidatures->total() }}</p>
            <p class="text-xs text-gray-500">Total candidatures</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-yellow-500">
            <p class="text-2xl font-bold text-yellow-600">{{ $candidatures->where('statut', 'en_attente')->count() }}</p>
            <p class="text-xs text-gray-500">En attente</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-green-500">
            <p class="text-2xl font-bold text-green-600">{{ $candidatures->where('statut', 'acceptee')->count() }}</p>
            <p class="text-xs text-gray-500">Acceptées</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-red-500">
            <p class="text-2xl font-bold text-red-600">{{ $candidatures->where('statut', 'refusee')->count() }}</p>
            <p class="text-xs text-gray-500">Refusées</p>
        </div>
    </div>

    <!-- Liste des candidatures -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        @if($candidatures->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-briefcase mr-1"></i> Stage
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-building mr-1"></i> Entreprise
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-calendar mr-1"></i> Date
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-info-circle mr-1"></i> Statut
                            </th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-cog mr-1"></i> Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($candidatures as $candidature)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $candidature->stage->titre ?? 'N/A' }}</div>
                                    <div class="text-xs text-gray-500">
                                        <i class="fas fa-map-marker-alt text-red-400"></i> {{ $candidature->stage->ville->nom ?? 'N/A' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($candidature->stage->entreprise->logo)
                                            <img src="{{ asset('storage/'.$candidature->stage->entreprise->logo) }}" 
                                                 alt="{{ $candidature->stage->entreprise->nom }}" 
                                                 class="h-8 w-8 rounded-full object-cover mr-3">
                                        @else
                                            <div class="h-8 w-8 rounded-full bg-gradient-to-r from-green-400 to-blue-400 flex items-center justify-center text-white font-bold text-xs mr-3">
                                                {{ strtoupper(substr($candidature->stage->entreprise->nom ?? 'E', 0, 1)) }}
                                            </div>
                                        @endif
                                        <span class="text-gray-700">{{ $candidature->stage->entreprise->nom ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $candidature->date_candidature ? \Carbon\Carbon::parse($candidature->date_candidature)->format('d/m/Y') : 'N/A' }}
                                    <br>
                                    <span class="text-xs text-gray-400">à {{ $candidature->date_candidature ? \Carbon\Carbon::parse($candidature->date_candidature)->format('H:i') : 'N/A' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        @if($candidature->statut == 'en_attente') bg-yellow-100 text-yellow-800
                                        @elseif($candidature->statut == 'acceptee') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        @if($candidature->statut == 'en_attente')
                                            <i class="fas fa-clock mr-1"></i> En attente
                                        @elseif($candidature->statut == 'acceptee')
                                            <i class="fas fa-check-circle mr-1"></i> Acceptée
                                        @else
                                            <i class="fas fa-times-circle mr-1"></i> Refusée
                                        @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('candidatures.show', $candidature) }}" 
                                           class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg text-sm transition flex items-center">
                                            <i class="fas fa-eye mr-1"></i> Voir
                                        </a>
                                        @if($candidature->statut == 'en_attente')
                                            <form action="{{ route('candidatures.destroy', $candidature) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Êtes-vous sûr de vouloir annuler cette candidature ?')" 
                                                        class="text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-lg text-sm transition flex items-center">
                                                    <i class="fas fa-times mr-1"></i> Annuler
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-16">
                <div class="text-6xl mb-4">📭</div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucune candidature</h3>
                <p class="text-gray-500 mb-6">Vous n'avez pas encore postulé à un stage.</p>
                <a href="{{ route('stages.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition shadow-md hover:shadow-lg">
                    <i class="fas fa-search mr-2"></i> Découvrir les stages
                </a>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $candidatures->links() }}
    </div>
</div>
@endsection