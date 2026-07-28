@extends('layouts.app')

@section('title', 'Mon espace - Gestion Stages SN')

@section('content')
<style>
    .welcome-banner {
        background: linear-gradient(135deg, #065F46 0%, #059669 50%, #10B981 100%);
        position: relative;
        overflow: hidden;
        border-radius: 1.5rem;
        padding: 1.75rem 2rem;
    }
    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -5%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    .welcome-banner::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: 10%;
        width: 200px;
        height: 200px;
        background: rgba(253,239,66,0.08);
        border-radius: 50%;
    }
    .stat-card {
        background: white;
        border-radius: 1rem;
        padding: 1rem 1.25rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.04);
        transition: all 0.2s ease;
        text-align: center;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px -8px rgba(0,0,0,0.08);
    }
    .stat-number {
        font-size: 1.75rem;
        font-weight: 800;
        line-height: 1.2;
    }
    .badge-status {
        font-size: 0.65rem;
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        letter-spacing: 0.025em;
    }
    .empty-state {
        background: #f8fafc;
        border: 2px dashed #e2e8f0;
        border-radius: 1.5rem;
        padding: 2.5rem 1.5rem;
        text-align: center;
    }
    .action-card {
        background: white;
        border-radius: 1rem;
        padding: 1.25rem;
        border: 1px solid rgba(0,0,0,0.04);
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }
    .action-card:hover {
        box-shadow: 0 8px 25px -8px rgba(0,0,0,0.08);
        transform: translateY(-3px);
        border-color: #10B981;
    }
    .candidature-item {
        transition: all 0.2s ease;
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        background: #fafafa;
    }
    .candidature-item:hover {
        background: #f0fdf4;
    }
</style>

@if(Auth::user()->role == 'etudiant')

<!-- BANNIÈRE DE BIENVENUE -->
<div class="welcome-banner mb-8 text-white">
    <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <div class="w-14 h-14 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-2xl font-bold border-2 border-white/30">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold">
                        Bonjour, <span class="text-yellow-300">{{ Auth::user()->name }}</span>
                    </h1>
                    <p class="text-green-100/90 text-sm flex items-center gap-2">
                        <span>🎓 Étudiant en L2 Réseaux & Télécoms</span>
                        <span class="w-1 h-1 bg-green-300 rounded-full"></span>
                        <span class="text-green-200 text-xs">
                            @if(($stats['mes_candidatures'] ?? 0) > 0)
                                {{ $stats['mes_candidatures'] }} candidature{{ $stats['mes_candidatures'] > 1 ? 's' : '' }} active{{ $stats['mes_candidatures'] > 1 ? 's' : '' }}
                            @else
                                Prêt à postuler !
                            @endif
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="mt-4 md:mt-0 flex flex-wrap gap-3">
            <a href="{{ route('stages.index') }}" class="bg-white/20 backdrop-blur-sm px-5 py-2.5 rounded-xl hover:bg-white/30 transition text-sm flex items-center border border-white/20">
                <i class="fas fa-search mr-2"></i> Explorer
            </a>
            <a href="{{ route('stages.index') }}" class="bg-yellow-400 text-green-900 px-5 py-2.5 rounded-xl hover:bg-yellow-300 transition text-sm font-semibold flex items-center shadow-lg">
                <i class="fas fa-rocket mr-2"></i> Trouver un stage
            </a>
        </div>
    </div>
</div>

<!-- STATISTIQUES PERSONNELLES -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <div class="stat-card">
        <div class="text-2xl mb-1">📄</div>
        <p class="stat-number text-blue-600">{{ $stats['mes_candidatures'] ?? 0 }}</p>
        <p class="text-xs text-gray-500 font-medium">Candidatures</p>
    </div>
    <div class="stat-card">
        <div class="text-2xl mb-1">⏳</div>
        <p class="stat-number text-yellow-600">{{ $stats['en_attente'] ?? 0 }}</p>
        <p class="text-xs text-gray-500 font-medium">En attente</p>
    </div>
    <div class="stat-card">
        <div class="text-2xl mb-1">✅</div>
        <p class="stat-number text-green-600">{{ $stats['acceptees'] ?? 0 }}</p>
        <p class="text-xs text-gray-500 font-medium">Acceptées</p>
    </div>
    <div class="stat-card">
        <div class="text-2xl mb-1">❌</div>
        <p class="stat-number text-red-600">{{ $stats['refusees'] ?? 0 }}</p>
        <p class="text-xs text-gray-500 font-medium">Refusées</p>
    </div>
</div>

<!-- ACTIONS RAPIDES -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <a href="{{ route('stages.index') }}" class="action-card flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-2xl flex-shrink-0">🔍</div>
        <div>
            <p class="font-semibold text-gray-800 text-sm">Explorer les stages</p>
            <p class="text-xs text-gray-500">Trouvez votre opportunité</p>
        </div>
        <i class="fas fa-arrow-right text-gray-300 ml-auto"></i>
    </a>
    <a href="{{ route('candidatures.index') }}" class="action-card flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-2xl flex-shrink-0">📋</div>
        <div>
            <p class="font-semibold text-gray-800 text-sm">Mes candidatures</p>
            <p class="text-xs text-gray-500">Suivez leur évolution</p>
        </div>
        <i class="fas fa-arrow-right text-gray-300 ml-auto"></i>
    </a>
    <a href="{{ route('profile.edit') }}" class="action-card flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center text-2xl flex-shrink-0">👤</div>
        <div>
            <p class="font-semibold text-gray-800 text-sm">Mon profil</p>
            <p class="text-xs text-gray-500">Mettez à jour vos infos</p>
        </div>
        <i class="fas fa-arrow-right text-gray-300 ml-auto"></i>
    </a>
</div>

<!-- MES CANDIDATURES RÉCENTES -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <div class="flex items-center justify-between mb-5">
        <div>
            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-file-signature text-blue-500"></i>
                Mes candidatures récentes
            </h3>
            <p class="text-xs text-gray-400 mt-0.5">Les 5 dernières candidatures</p>
        </div>
        <a href="{{ route('candidatures.index') }}" class="text-sm font-medium text-green-600 hover:text-green-700 hover:underline flex items-center">
            Voir tout <i class="fas fa-arrow-right ml-1 text-xs"></i>
        </a>
    </div>

    @if($mesCandidatures->count() > 0)
        <div class="space-y-2">
            @foreach($mesCandidatures as $candidature)
                <div class="candidature-item flex items-center justify-between">
                    <div class="flex items-center gap-3 flex-1 min-w-0">
                        <span class="text-lg flex-shrink-0">📌</span>
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold text-gray-800 text-sm truncate">{{ $candidature->stage->titre ?? 'Stage supprimé' }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ $candidature->stage->entreprise->nom ?? 'Entreprise' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 flex-shrink-0">
                        <span class="badge-status
                            @if($candidature->statut == 'en_attente') bg-yellow-100 text-yellow-700
                            @elseif($candidature->statut == 'acceptee') bg-green-100 text-green-700
                            @else bg-red-100 text-red-700 @endif">
                            @if($candidature->statut == 'en_attente')
                                <i class="fas fa-clock mr-1"></i>
                            @elseif($candidature->statut == 'acceptee')
                                <i class="fas fa-check-circle mr-1"></i>
                            @else
                                <i class="fas fa-times-circle mr-1"></i>
                            @endif
                            {{ ucfirst($candidature->statut) }}
                        </span>
                        <a href="{{ route('candidatures.show', $candidature) }}" class="text-gray-400 hover:text-blue-600 transition text-sm">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="text-5xl mb-3">📭</div>
            <h4 class="text-lg font-semibold text-gray-700 mb-1">Aucune candidature</h4>
            <p class="text-sm text-gray-500 max-w-md mx-auto">
                Vous n'avez pas encore postulé. Lancez-vous dès maintenant !
            </p>
            <a href="{{ route('stages.index') }}" class="inline-block mt-4 px-6 py-2.5 bg-green-600 text-white rounded-xl hover:bg-green-700 transition text-sm font-medium">
                <i class="fas fa-search mr-2"></i> Découvrir les stages
            </a>
        </div>
    @endif
</div>

@endif
@endsection