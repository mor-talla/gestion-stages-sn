@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- En-tête avec drapeau -->
        <div class="bg-gradient-to-r from-green-600 via-yellow-400 to-red-600 h-2"></div>
        
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-user-circle text-green-600"></i> Mon Profil
                </h2>
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                    <i class="fas fa-check-circle"></i> Connecté
                </span>
            </div>

            <!-- Informations utilisateur -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="md:col-span-1 flex flex-col items-center">
                    <div class="w-32 h-32 rounded-full bg-gradient-to-br from-green-500 to-yellow-400 flex items-center justify-center text-5xl text-white font-bold shadow-lg">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-gray-800">{{ Auth::user()->name }}</h3>
                    <span class="text-sm bg-blue-100 text-blue-700 px-3 py-1 rounded-full mt-1">
                        <i class="fas fa-{{ Auth::user()->role === 'admin' ? 'crown' : (Auth::user()->role === 'entreprise' ? 'building' : 'graduation-cap') }}"></i>
                        {{ ucfirst(Auth::user()->role) }}
                    </span>
                </div>

                <div class="md:col-span-2">
                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                                <input type="text" name="telephone" value="{{ old('telephone', Auth::user()->telephone) }}" 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                @error('telephone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Rôle</label>
                                <input type="text" value="{{ ucfirst(Auth::user()->role) }}" disabled 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100 text-gray-600">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                            <input type="text" name="adresse" value="{{ old('adresse', Auth::user()->adresse) }}" 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            @error('adresse')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <h4 class="font-semibold text-gray-700 mb-3">Changer le mot de passe</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nouveau mot de passe</label>
                                    <input type="password" name="password" 
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirmer</label>
                                    <input type="password" name="password_confirmation" 
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                </div>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-3 pt-4">
                            <a href="{{ route('dashboard') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                                Annuler
                            </a>
                            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center">
                                <i class="fas fa-save mr-2"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Section statistiques personnelles -->
<div class="border-t border-gray-200 pt-6 mt-4">
    <h4 class="font-semibold text-gray-700 mb-4">Mes statistiques</h4>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-blue-50 p-4 rounded-lg text-center">
            <p class="text-2xl font-bold text-blue-600">{{ Auth::user()->candidatures()->count() }}</p>
            <p class="text-sm text-gray-600">Candidatures</p>
        </div>
        <div class="bg-green-50 p-4 rounded-lg text-center">
            <p class="text-2xl font-bold text-green-600">{{ Auth::user()->candidatures()->where('statut', 'acceptee')->count() }}</p>
            <p class="text-sm text-gray-600">Stages acceptés</p>
        </div>
        <div class="bg-yellow-50 p-4 rounded-lg text-center">
            <p class="text-2xl font-bold text-yellow-600">{{ Auth::user()->candidatures()->where('statut', 'en_attente')->count() }}</p>
            <p class="text-sm text-gray-600">En attente</p>
        </div>
        <div class="bg-red-50 p-4 rounded-lg text-center">
            <p class="text-2xl font-bold text-red-600">{{ Auth::user()->candidatures()->where('statut', 'refusee')->count() }}</p>
            <p class="text-sm text-gray-600">Refusés</p>
        </div>
    </div>
</div>