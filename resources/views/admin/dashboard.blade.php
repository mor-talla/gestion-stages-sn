@extends('layouts.admin')

@section('title', 'Tableau de bord - Admin')
@section('page-title', 'Tableau de bord')
@section('page-subtitle', 'Vue d\'ensemble de la plateforme')

@section('content')
<!-- Statistiques -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="stat-card bg-white p-5 rounded-2xl shadow-sm border border-gray-100 fade-in">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wider">Utilisateurs</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_users'] }}</p>
                <p class="text-xs text-gray-400 mt-1">
                    <span class="text-green-600">{{ $stats['total_etudiants'] }}</span> étudiants, 
                    <span class="text-blue-600">{{ $stats['total_entreprises'] }}</span> entreprises
                </p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center">
                <i class="fas fa-users text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="stat-card bg-white p-5 rounded-2xl shadow-sm border border-gray-100 fade-in">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wider">Stages</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_stages'] }}</p>
                <p class="text-xs text-gray-400 mt-1">
                    <span class="text-green-600">{{ $stats['stages_ouverts'] }}</span> ouverts,
                    <span class="text-red-600">{{ $stats['stages_fermes'] }}</span> fermés
                </p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center">
                <i class="fas fa-briefcase text-green-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="stat-card bg-white p-5 rounded-2xl shadow-sm border border-gray-100 fade-in">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wider">Entreprises</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_entreprises_partenaires'] }}</p>
                <p class="text-xs text-gray-400 mt-1">Partenaires actifs</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center">
                <i class="fas fa-building text-purple-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="stat-card bg-white p-5 rounded-2xl shadow-sm border border-gray-100 fade-in">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wider">Candidatures</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_candidatures'] }}</p>
                <p class="text-xs text-gray-400 mt-1">
                    <span class="text-yellow-600">{{ $stats['candidatures_en_attente'] }}</span> en attente
                </p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-2xl flex items-center justify-center">
                <i class="fas fa-file-signature text-yellow-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Stats détaillées -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-center fade-in">
        <p class="text-2xl font-bold text-green-600">{{ $stats['candidatures_acceptees'] }}</p>
        <p class="text-xs text-gray-500 font-medium">✅ Acceptées</p>
    </div>
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-center fade-in">
        <p class="text-2xl font-bold text-yellow-600">{{ $stats['candidatures_en_attente'] }}</p>
        <p class="text-xs text-gray-500 font-medium">⏳ En attente</p>
    </div>
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-center fade-in">
        <p class="text-2xl font-bold text-red-600">{{ $stats['candidatures_refusees'] }}</p>
        <p class="text-xs text-gray-500 font-medium">❌ Refusées</p>
    </div>
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-center fade-in">
        <p class="text-2xl font-bold text-blue-600">{{ $stats['total_admins'] }}</p>
        <p class="text-xs text-gray-500 font-medium">👑 Administrateurs</p>
    </div>
</div>

<!-- Dernières activités -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Derniers utilisateurs -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-800">
                <i class="fas fa-user-plus text-blue-500 mr-2"></i>
                Derniers inscrits
            </h3>
            <a href="{{ route('admin.users') }}" class="text-sm text-green-600 hover:text-green-700 font-medium">
                Voir tout →
            </a>
        </div>
        @if($derniersUtilisateurs->count() > 0)
            <div class="space-y-3">
                @foreach($derniersUtilisateurs as $user)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full
                            @if($user->role == 'admin') bg-yellow-100 text-yellow-700
                            @elseif($user->role == 'entreprise') bg-blue-100 text-blue-700
                            @else bg-green-100 text-green-700 @endif">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-4">Aucun utilisateur</p>
        @endif
    </div>

    <!-- Derniers stages -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-800">
                <i class="fas fa-clock text-green-500 mr-2"></i>
                Derniers stages
            </h3>
            <a href="{{ route('admin.stages') }}" class="text-sm text-green-600 hover:text-green-700 font-medium">
                Voir tout →
            </a>
        </div>
        @if($derniersStages->count() > 0)
            <div class="space-y-3">
                @foreach($derniersStages as $stage)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">{{ $stage->titre }}</p>
                            <p class="text-xs text-gray-500">{{ $stage->entreprise->nom ?? 'N/A' }}</p>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full
                            @if($stage->statut == 'ouvert') bg-green-100 text-green-700
                            @elseif($stage->statut == 'en_cours') bg-yellow-100 text-yellow-700
                            @else bg-gray-100 text-gray-500 @endif">
                            {{ ucfirst($stage->statut) }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-4">Aucun stage</p>
        @endif
    </div>
</div>

<!-- Top entreprises et dernières candidatures -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
    <!-- Top entreprises -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">
            <i class="fas fa-trophy text-yellow-500 mr-2"></i>
            Top entreprises
        </h3>
        @if($topEntreprises->count() > 0)
            <div class="space-y-3">
                @foreach($topEntreprises as $entreprise)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">{{ $entreprise->nom }}</p>
                            <p class="text-xs text-gray-500">{{ $entreprise->secteur_activite }}</p>
                        </div>
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $entreprise->stages_count }} stages
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-4">Aucune entreprise</p>
        @endif
    </div>

    <!-- Dernières candidatures -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">
            <i class="fas fa-file-signature text-blue-500 mr-2"></i>
            Dernières candidatures
        </h3>
        @if($dernieresCandidatures->count() > 0)
            <div class="space-y-3">
                @foreach($dernieresCandidatures as $candidature)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">{{ $candidature->nom_candidat }} {{ $candidature->prenom }}</p>
                            <p class="text-xs text-gray-500">{{ $candidature->stage->titre ?? 'N/A' }}</p>
                        </div>
                        <span class="text-xs px-3 py-1 rounded-full
                            @if($candidature->statut == 'en_attente') bg-yellow-100 text-yellow-700
                            @elseif($candidature->statut == 'acceptee') bg-green-100 text-green-700
                            @else bg-red-100 text-red-700 @endif">
                            {{ ucfirst($candidature->statut) }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-4">Aucune candidature</p>
        @endif
    </div>
</div>
@endsection