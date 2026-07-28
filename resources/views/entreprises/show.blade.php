@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-green-600 via-yellow-400 to-red-600 h-2"></div>
        
        <div class="p-8">
            <!-- En-tête -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="flex items-center">
                   @if($entreprise->logo)
    <img src="{{ asset('storage/' . $entreprise->logo) }}" 
         alt="{{ $entreprise->nom }}" 
         class="h-20 w-20 rounded-full object-cover border-4 border-green-200">
@else
    <div class="h-20 w-20 rounded-full bg-gradient-to-r from-green-400 to-blue-400 flex items-center justify-center text-3xl text-white font-bold">
        {{ strtoupper(substr($entreprise->nom, 0, 2)) }}
    </div>
@endif
                    <div class="ml-5">
                        <h1 class="text-2xl font-bold text-gray-800">{{ $entreprise->nom }}</h1>
                        <p class="text-gray-600">
                            <i class="fas fa-tag text-purple-500"></i> {{ ucfirst($entreprise->secteur_activite) }}
                            <span class="mx-2">•</span>
                            <i class="fas fa-users text-gray-400"></i> {{ $entreprise->taille ?? 'Taille non précisée' }}
                        </p>
                    </div>
                </div>
                <div class="mt-4 md:mt-0 flex space-x-3">
                    @auth
                        @if(Auth::user()->role == 'admin')
                            <a href="{{ route('entreprises.edit', $entreprise) }}" 
                               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm flex items-center">
                                <i class="fas fa-edit mr-2"></i> Modifier
                            </a>
                            <form action="{{ route('entreprises.destroy', $entreprise) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Supprimer cette entreprise ?')" 
                                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm flex items-center">
                                    <i class="fas fa-trash mr-2"></i> Supprimer
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Informations -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-xs text-gray-500 uppercase font-semibold">Email</p>
                    <p class="text-gray-700">
                        <i class="fas fa-envelope text-blue-500 mr-2"></i>
                        <a href="mailto:{{ $entreprise->email }}" class="hover:text-blue-600">{{ $entreprise->email }}</a>
                    </p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-xs text-gray-500 uppercase font-semibold">Téléphone</p>
                    <p class="text-gray-700">
                        <i class="fas fa-phone text-green-500 mr-2"></i>
                        <a href="tel:{{ $entreprise->telephone }}" class="hover:text-green-600">{{ $entreprise->telephone }}</a>
                    </p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-xs text-gray-500 uppercase font-semibold">Localisation</p>
                    <p class="text-gray-700">
                        <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                        {{ $entreprise->ville->nom ?? 'N/A' }}, Sénégal
                    </p>
                </div>
                <div class="md:col-span-3 bg-gray-50 p-4 rounded-lg">
                    <p class="text-xs text-gray-500 uppercase font-semibold">Adresse</p>
                    <p class="text-gray-700">{{ $entreprise->adresse }}</p>
                </div>
                @if($entreprise->site_web)
                    <div class="md:col-span-3 bg-gray-50 p-4 rounded-lg">
                        <p class="text-xs text-gray-500 uppercase font-semibold">Site Web</p>
                        <p class="text-gray-700">
                            <i class="fas fa-globe text-blue-500 mr-2"></i>
                            <a href="{{ $entreprise->site_web }}" target="_blank" class="hover:text-blue-600">{{ $entreprise->site_web }}</a>
                        </p>
                    </div>
                @endif
            </div>

            <!-- Description -->
            @if($entreprise->description)
                <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-semibold text-gray-700 uppercase">Description</h3>
                    <p class="text-gray-600 mt-2">{{ $entreprise->description }}</p>
                </div>
            @endif

            <!-- Stages de l'entreprise -->
            <div class="mt-8">
                <h3 class="text-xl font-bold text-gray-800 flex items-center mb-4">
                    <i class="fas fa-briefcase text-green-600 mr-2"></i>
                    Stages proposés ({{ $entreprise->stages->count() }})
                </h3>
                @if($entreprise->stages->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($entreprise->stages as $stage)
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                                <h4 class="font-semibold text-gray-800">
                                    <a href="{{ route('stages.show', $stage) }}" class="hover:text-green-600">
                                        {{ $stage->titre }}
                                    </a>
                                </h4>
                                <p class="text-sm text-gray-500">
                                    <i class="fas fa-calendar mr-1"></i> 
value="{{ old('date_debut', isset($stage->date_debut) ? \Carbon\Carbon::parse($stage->date_debut)->format('Y-m-d') : '') }}"                                </p>
                                <span class="text-xs px-2 py-1 rounded-full
                                    @if($stage->statut == 'ouvert') bg-green-100 text-green-700
                                    @elseif($stage->statut == 'en_cours') bg-yellow-100 text-yellow-700
                                    @else bg-red-100 text-red-700 @endif">
                                    {{ ucfirst($stage->statut) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm">Cette entreprise n'a pas encore publié de stages.</p>
                @endif
            </div>

            <!-- Bouton retour -->
            <div class="mt-8 border-t border-gray-200 pt-6">
                <a href="{{ route('entreprises.index') }}" class="text-gray-600 hover:text-gray-800 transition flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
                </a>
            </div>
        </div>
    </div>
</div>
@endsection