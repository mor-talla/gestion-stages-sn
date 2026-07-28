@extends('layouts.app')

@section('title', 'Entreprises - Gestion Stages SN')

@section('content')
<style>
    .company-card {
        background: white;
        border-radius: 1.5rem;
        border: 1px solid rgba(0,0,0,0.04);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }
    .company-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -12px rgba(0,0,0,0.12);
        border-color: rgba(16,185,129,0.15);
    }
    .company-card .company-header {
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    .company-card .company-header .pattern {
        position: absolute;
        inset: 0;
        opacity: 0.15;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='40' fill='white'/%3E%3C/svg%3E");
        background-size: 30px 30px;
    }
    .company-card .company-logo {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        border: 4px solid white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.5rem;
        color: white;
        position: relative;
        z-index: 2;
        flex-shrink: 0;
    }
    .company-card .company-logo img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }
    .company-stats {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.75rem;
        color: #6B7280;
    }
    .company-stats .stat-item {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        background: #f3f4f6;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
    }
    .filter-section {
        background: white;
        border-radius: 1.5rem;
        padding: 1.5rem;
        border: 1px solid rgba(0,0,0,0.04);
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }
    .filter-section input, .filter-section select {
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 0.625rem 1rem;
        transition: all 0.2s ease;
        background: #fafafa;
        width: 100%;
    }
    .filter-section input:focus, .filter-section select:focus {
        border-color: #10B981;
        ring: 2px solid rgba(16,185,129,0.1);
        background: white;
        outline: none;
    }
    .sector-badge {
        font-size: 0.6rem;
        font-weight: 600;
        padding: 0.2rem 0.7rem;
        border-radius: 9999px;
        letter-spacing: 0.025em;
        text-transform: uppercase;
    }
    .empty-state {
        background: #f8fafc;
        border: 2px dashed #e2e8f0;
        border-radius: 1.5rem;
        padding: 4rem 2rem;
        text-align: center;
    }
    .btn-action {
        transition: all 0.2s ease;
        border-radius: 0.75rem;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .pagination-custom .page-link {
        border-radius: 0.75rem;
        margin: 0 0.25rem;
        padding: 0.5rem 1rem;
        border: 1px solid #e5e7eb;
        color: #4B5563;
        transition: all 0.2s ease;
    }
    .pagination-custom .page-link:hover {
        background: #f3f4f6;
        border-color: #10B981;
    }
    .pagination-custom .active .page-link {
        background: #10B981;
        border-color: #10B981;
        color: white;
    }
    .add-btn {
        background: linear-gradient(135deg, #065F46, #059669);
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(5,150,105,0.25);
    }
    .add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(5,150,105,0.3);
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .company-card {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
    }
    .company-card:nth-child(1) { animation-delay: 0.05s; }
    .company-card:nth-child(2) { animation-delay: 0.1s; }
    .company-card:nth-child(3) { animation-delay: 0.15s; }
    .company-card:nth-child(4) { animation-delay: 0.2s; }
    .company-card:nth-child(5) { animation-delay: 0.25s; }
    .company-card:nth-child(6) { animation-delay: 0.3s; }
    .company-card:nth-child(7) { animation-delay: 0.35s; }
    .company-card:nth-child(8) { animation-delay: 0.4s; }
    .company-card:nth-child(9) { animation-delay: 0.45s; }
    .company-card:nth-child(10) { animation-delay: 0.5s; }
</style>

<!-- En-tête -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
    <div>
        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-800 flex items-center gap-3">
            <i class="fas fa-building text-green-600"></i>
            Entreprises partenaires
        </h2>
        <p class="text-gray-500 text-sm mt-1">
            <span class="font-semibold text-green-600">{{ $entreprises->total() }}</span> entreprises recrutent actuellement
        </p>
    </div>
    @auth
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'entreprise')
            <a href="{{ route('entreprises.create') }}" 
               class="add-btn text-white px-6 py-2.5 rounded-xl font-semibold text-sm flex items-center gap-2 mt-4 md:mt-0">
                <i class="fas fa-plus-circle"></i>
                Ajouter une entreprise
            </a>
        @endif
    @endauth
</div>

<!-- Filtres -->
<div class="filter-section mb-8">
    <form method="GET" action="{{ route('entreprises.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="text-xs font-medium text-gray-500 uppercase block mb-1">Recherche</label>
            <input type="text" name="search" placeholder="Nom, secteur..." value="{{ request('search') }}">
        </div>
        <div>
            <label class="text-xs font-medium text-gray-500 uppercase block mb-1">Secteur</label>
            <select name="secteur">
                <option value="">Tous les secteurs</option>
                <option value="telecom" {{ request('secteur')=='telecom'?'selected':'' }}>📡 Télécommunications</option>
                <option value="banque" {{ request('secteur')=='banque'?'selected':'' }}>🏦 Banque & Finance</option>
                <option value="sante" {{ request('secteur')=='sante'?'selected':'' }}>🏥 Santé</option>
                <option value="education" {{ request('secteur')=='education'?'selected':'' }}>📚 Éducation</option>
                <option value="agriculture" {{ request('secteur')=='agriculture'?'selected':'' }}>🌾 Agriculture</option>
                <option value="commerce" {{ request('secteur')=='commerce'?'selected':'' }}>🛒 Commerce</option>
                <option value="industrie" {{ request('secteur')=='industrie'?'selected':'' }}>🏭 Industrie</option>
                <option value="tech" {{ request('secteur')=='tech'?'selected':'' }}>💻 Technologies</option>
                <option value="transport" {{ request('secteur')=='transport'?'selected':'' }}>🚚 Transport</option>
                <option value="hotellerie" {{ request('secteur')=='hotellerie'?'selected':'' }}>🏨 Hôtellerie</option>
            </select>
        </div>
        <div>
            <label class="text-xs font-medium text-gray-500 uppercase block mb-1">Ville</label>
            <select name="ville">
                <option value="">Toutes les villes</option>
                @foreach(\App\Models\Ville::all() as $ville)
                    <option value="{{ $ville->id }}" {{ request('ville')==$ville->id?'selected':'' }}>{{ $ville->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2.5 rounded-xl hover:bg-blue-700 transition flex items-center justify-center gap-2 font-medium">
                <i class="fas fa-filter"></i> Filtrer
            </button>
        </div>
    </form>
</div>

<!-- Liste des entreprises -->
@if($entreprises->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($entreprises as $entreprise)
            @php
                $sectorColors = [
                    'telecom' => 'bg-blue-100 text-blue-700',
                    'banque' => 'bg-green-100 text-green-700',
                    'sante' => 'bg-red-100 text-red-700',
                    'education' => 'bg-purple-100 text-purple-700',
                    'agriculture' => 'bg-yellow-100 text-yellow-700',
                    'commerce' => 'bg-orange-100 text-orange-700',
                    'industrie' => 'bg-indigo-100 text-indigo-700',
                    'tech' => 'bg-cyan-100 text-cyan-700',
                    'transport' => 'bg-amber-100 text-amber-700',
                    'hotellerie' => 'bg-pink-100 text-pink-700',
                ];
                $headerColors = [
                    'telecom' => 'from-blue-500 to-blue-600',
                    'banque' => 'from-green-500 to-green-600',
                    'sante' => 'from-red-500 to-red-600',
                    'education' => 'from-purple-500 to-purple-600',
                    'agriculture' => 'from-yellow-500 to-yellow-600',
                    'commerce' => 'from-orange-500 to-orange-600',
                    'industrie' => 'from-indigo-500 to-indigo-600',
                    'tech' => 'from-cyan-500 to-cyan-600',
                    'transport' => 'from-amber-500 to-amber-600',
                    'hotellerie' => 'from-pink-500 to-pink-600',
                ];
                $bgColor = $headerColors[$entreprise->secteur_activite] ?? 'from-gray-500 to-gray-600';
            @endphp
            <div class="company-card">
                <!-- Header avec gradient -->
                <div class="company-header bg-gradient-to-r {{ $bgColor }}">
                    <div class="pattern"></div>
                    <div class="company-logo">
                        @if($entreprise->logo)
                            <img src="{{ asset('storage/'.$entreprise->logo) }}" alt="{{ $entreprise->nom }}">
                        @else
                            {{ strtoupper(substr($entreprise->nom, 0, 2)) }}
                        @endif
                    </div>
                </div>
                
                <!-- Contenu -->
                <div class="p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg leading-tight">{{ $entreprise->nom }}</h4>
                            <span class="sector-badge {{ $sectorColors[$entreprise->secteur_activite] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ $entreprise->secteur_activite }}
                            </span>
                        </div>
                        <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">
                            {{ $entreprise->stages_count ?? 0 }} stages
                        </span>
                    </div>

                    <div class="mt-3 space-y-1.5 text-sm text-gray-500">
                        <p class="flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-red-400 w-4"></i>
                            {{ $entreprise->ville->nom ?? 'Sénégal' }}
                        </p>
                        <p class="flex items-center gap-2">
                            <i class="fas fa-envelope text-gray-400 w-4"></i>
                            <a href="mailto:{{ $entreprise->email }}" class="hover:text-green-600">{{ $entreprise->email }}</a>
                        </p>
                        <p class="flex items-center gap-2">
                            <i class="fas fa-phone text-gray-400 w-4"></i>
                            <a href="tel:{{ $entreprise->telephone }}" class="hover:text-green-600">{{ $entreprise->telephone }}</a>
                        </p>
                        @if($entreprise->site_web)
                            <p class="flex items-center gap-2">
                                <i class="fas fa-globe text-blue-400 w-4"></i>
                                <a href="{{ $entreprise->site_web }}" target="_blank" class="hover:text-blue-600">Site web</a>
                            </p>
                        @endif
                    </div>

                    @if($entreprise->description)
                        <p class="text-sm text-gray-600 mt-3 line-clamp-2">{{ $entreprise->description }}</p>
                    @endif

                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                        <div class="company-stats">
                            <span class="stat-item">
                                <i class="fas fa-briefcase text-green-500"></i>
                                {{ $entreprise->stages_count ?? 0 }} stages
                            </span>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('entreprises.show', $entreprise) }}" 
                               class="px-4 py-1.5 bg-green-50 text-green-700 rounded-lg text-sm font-medium hover:bg-green-100 transition">
                                Voir
                            </a>
                            @auth
                                @if(Auth::user()->role == 'admin' || (Auth::user()->role == 'entreprise' && Auth::user()->entreprise_id == $entreprise->id))
                                    <a href="{{ route('entreprises.edit', $entreprise) }}" 
                                       class="px-4 py-1.5 bg-blue-50 text-blue-700 rounded-lg text-sm font-medium hover:bg-blue-100 transition">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('entreprises.destroy', $entreprise) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Supprimer cette entreprise ?')" 
                                                class="px-4 py-1.5 bg-red-50 text-red-700 rounded-lg text-sm font-medium hover:bg-red-100 transition">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8 pagination-custom">
        {{ $entreprises->links() }}
    </div>

@else
    <div class="empty-state">
        <div class="text-6xl mb-4">🏢</div>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucune entreprise trouvée</h3>
        <p class="text-gray-500 max-w-md mx-auto">Aucune entreprise ne correspond à vos critères de recherche.</p>
        @auth
            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'entreprise')
                <a href="{{ route('entreprises.create') }}" class="inline-block mt-4 px-6 py-2.5 bg-green-600 text-white rounded-xl hover:bg-green-700 transition">
                    <i class="fas fa-plus mr-2"></i> Ajouter une entreprise
                </a>
            @endif
        @endauth
    </div>
@endif

@endsection