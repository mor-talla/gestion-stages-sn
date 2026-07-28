@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-green-600 via-yellow-400 to-red-600 h-2"></div>
        
        <div class="p-6 md:p-8">
            <!-- En-tête -->
            <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                <div class="flex-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">{{ $stage->titre }}</h1>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                            @if($stage->statut == 'ouvert') bg-green-100 text-green-700
                            @elseif($stage->statut == 'en_cours') bg-yellow-100 text-yellow-700
                            @else bg-red-100 text-red-700 @endif">
                            {{ ucfirst($stage->statut) }}
                        </span>
                    </div>
                    <p class="text-gray-600 mt-2 flex items-center flex-wrap gap-2">
                        <i class="fas fa-building text-green-600"></i>
                        <a href="{{ route('entreprises.show', $stage->entreprise) }}" class="hover:text-green-600 hover:underline font-medium">
                            {{ $stage->entreprise->nom }}
                        </a>
                        <span class="text-gray-300">|</span>
                        <span class="text-sm text-gray-500">
                            <i class="fas fa-tag text-purple-400"></i> {{ ucfirst($stage->type) }}
                        </span>
                    </p>
                </div>
                <div class="mt-4 md:mt-0 flex flex-wrap gap-2">
                    @auth
                        @if(Auth::user()->role == 'admin' || (Auth::user()->role == 'entreprise' && Auth::user()->entreprise_id == $stage->entreprise_id))
                            <a href="{{ route('stages.edit', $stage) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm shadow-sm hover:shadow">
                                <i class="fas fa-edit mr-2"></i> Modifier
                            </a>
                            <form action="{{ route('stages.destroy', $stage) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stage ?')" 
                                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm shadow-sm hover:shadow">
                                    <i class="fas fa-trash mr-2"></i> Supprimer
                                </button>
                            </form>
                        @elseif(Auth::user()->role == 'etudiant')
                            @if($stage->statut == 'ouvert' || $stage->statut == 'en_cours')
                                <a href="{{ route('candidatures.create', $stage) }}" 
                                   class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:from-green-700 hover:to-green-800 transition shadow-md hover:shadow-lg text-sm">
                                    <i class="fas fa-paper-plane mr-2"></i> Postuler maintenant
                                </a>
                            @else
                                <span class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-500 rounded-lg text-sm cursor-not-allowed">
                                    <i class="fas fa-lock mr-2"></i> Stage fermé
                                </span>
                            @endif
                        @endif
                    @else
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition shadow-md hover:shadow-lg text-sm">
                            <i class="fas fa-sign-in-alt mr-2"></i> Connectez-vous pour postuler
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Informations clés -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 mt-6 bg-gray-50 p-4 md:p-5 rounded-xl border border-gray-100">
                <div class="text-center md:text-left">
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">
                        <i class="fas fa-map-marker-alt text-red-400 mr-1"></i> Localisation
                    </p>
                    <p class="font-semibold text-gray-700 text-sm md:text-base">
                        {{ $stage->ville->nom ?? 'N/A' }}
                    </p>
                </div>
                <div class="text-center md:text-left">
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">
                        <i class="fas fa-clock text-yellow-500 mr-1"></i> Durée
                    </p>
                    <p class="font-semibold text-gray-700 text-sm md:text-base">
                        {{ $stage->duree }}
                    </p>
                </div>
                <div class="text-center md:text-left">
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">
                        <i class="fas fa-tag text-purple-500 mr-1"></i> Type
                    </p>
                    <span class="inline-block px-2.5 py-0.5 bg-blue-100 text-blue-700 rounded text-xs font-semibold">
                        {{ ucfirst($stage->type) }}
                    </span>
                </div>
                <div class="text-center md:text-left">
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">
                        <i class="fas fa-money-bill-wave text-green-500 mr-1"></i> Rémunération
                    </p>
                    @if($stage->remuneration)
                        <p class="font-bold text-green-600 text-sm md:text-base">
                            {{ number_format($stage->montant_remuneration, 0, ',', ' ') }} CFA
                        </p>
                    @else
                        <p class="text-gray-500 text-sm">
                            <i class="fas fa-times-circle text-gray-400 mr-1"></i> Non rémunéré
                        </p>
                    @endif
                </div>
            </div>

            <!-- Description -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-700 flex items-center">
                    <i class="fas fa-align-left text-gray-500 mr-2"></i>
                    Description du stage
                </h3>
                <div class="mt-3 bg-gray-50 p-5 rounded-xl border border-gray-100">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $stage->description }}</p>
                </div>
            </div>

            <!-- Compétences requises -->
            @if($stage->competences_requises)
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-brain text-purple-500 mr-2"></i>
                        Compétences requises
                    </h3>
                    <div class="mt-3 bg-purple-50 p-5 rounded-xl border border-purple-100">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $stage->competences_requises }}</p>
                    </div>
                </div>
            @endif

            <!-- Dates -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 mt-8">
                <div class="bg-blue-50 p-4 rounded-xl text-center border border-blue-100">
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">
                        <i class="fas fa-calendar-plus text-blue-500 mr-1"></i> Début
                    </p>
                    <p class="font-semibold text-gray-700 text-sm md:text-base">
                        {{ $stage->date_debut ? \Carbon\Carbon::parse($stage->date_debut)->format('d/m/Y') : 'Non définie' }}
                    </p>
                </div>
                <div class="bg-red-50 p-4 rounded-xl text-center border border-red-100">
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">
                        <i class="fas fa-calendar-minus text-red-500 mr-1"></i> Fin
                    </p>
                    <p class="font-semibold text-gray-700 text-sm md:text-base">
                        {{ $stage->date_fin ? \Carbon\Carbon::parse($stage->date_fin)->format('d/m/Y') : 'Non définie' }}
                    </p>
                </div>
                <div class="bg-yellow-50 p-4 rounded-xl text-center border border-yellow-100">
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">
                        <i class="fas fa-hourglass-end text-yellow-500 mr-1"></i> Limite
                    </p>
                    <p class="font-semibold text-gray-700 text-sm md:text-base">
                        {{ $stage->date_limite_candidature ? \Carbon\Carbon::parse($stage->date_limite_candidature)->format('d/m/Y') : 'Non définie' }}
                    </p>
                </div>
                <div class="bg-green-50 p-4 rounded-xl text-center border border-green-100">
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">
                        <i class="fas fa-users text-green-500 mr-1"></i> Postes
                    </p>
                    <p class="font-semibold text-gray-700 text-sm md:text-base">
                        {{ $stage->nb_postes }} place{{ $stage->nb_postes > 1 ? 's' : '' }}
                    </p>
                </div>
            </div>

            <!-- Adresse exacte -->
            @if($stage->adresse_exacte)
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-location-dot text-red-500 mr-2"></i>
                        Adresse exacte
                    </h3>
                    <div class="mt-3 bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-gray-600">
                            <i class="fas fa-map-pin text-red-400 mr-2"></i>
                            {{ $stage->adresse_exacte }}
                        </p>
                    </div>
                </div>
            @endif

            <!-- Bouton retour -->
            <div class="mt-8 border-t border-gray-200 pt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                <a href="{{ route('stages.index') }}" class="text-gray-600 hover:text-gray-800 transition flex items-center text-sm">
                    <i class="fas fa-arrow-left mr-2"></i> Retour à la liste des stages
                </a>
                <div class="flex flex-wrap gap-2">
                    @auth
                        @if(Auth::user()->role == 'admin' || (Auth::user()->role == 'entreprise' && Auth::user()->entreprise_id == $stage->entreprise_id))
                            <a href="{{ route('stages.edit', $stage) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm">
                                <i class="fas fa-edit mr-2"></i> Modifier
                            </a>
                        @endif
                        @if(Auth::user()->role == 'etudiant' && ($stage->statut == 'ouvert' || $stage->statut == 'en_cours'))
                            <a href="{{ route('candidatures.create', $stage) }}" 
                               class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:from-green-700 hover:to-green-800 transition shadow-md hover:shadow-lg text-sm">
                                <i class="fas fa-paper-plane mr-2"></i> Postuler
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Section des candidatures (visible uniquement pour admin/entreprise) -->
    @auth
        @if(Auth::user()->role == 'admin' || (Auth::user()->role == 'entreprise' && Auth::user()->entreprise_id == $stage->entreprise_id))
            <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-users text-blue-500 mr-2"></i>
                        Candidatures reçues ({{ $stage->candidatures->count() }})
                    </h3>
                    @if($stage->candidatures->count() > 0)
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Candidat</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Email</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Date</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Statut</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($stage->candidatures as $candidature)
                                        <tr>
                                            <td class="px-4 py-3 text-sm">{{ $candidature->nom_candidat }} {{ $candidature->prenom }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $candidature->email }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                @if($candidature->date_candidature)
                                                    {{ \Carbon\Carbon::parse($candidature->date_candidature)->format('d/m/Y') }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">
                                                <span class="px-2 py-1 text-xs rounded-full
                                                    @if($candidature->statut == 'en_attente') bg-yellow-100 text-yellow-700
                                                    @elseif($candidature->statut == 'acceptee') bg-green-100 text-green-700
                                                    @else bg-red-100 text-red-700 @endif">
                                                    {{ ucfirst($candidature->statut) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-3"></i>
                            <p>Aucune candidature reçue pour ce stage.</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    @endauth
</div>
@endsection