@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-green-600 via-yellow-400 to-red-600 h-2"></div>
        
        <div class="p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-plus-circle text-green-600 text-3xl mr-3"></i>
                    Publier un stage
                </h2>
                <a href="{{ route('stages.index') }}" class="text-gray-500 hover:text-gray-700 transition">
                    <i class="fas fa-times text-xl"></i>
                </a>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('stages.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Titre -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-heading text-blue-600 mr-2"></i>
                            Titre du stage <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="titre" value="{{ old('titre') }}" required 
                               placeholder="Ex: Développeur Web Full Stack"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-align-left text-gray-600 mr-2"></i>
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" rows="6" required 
                                  placeholder="Décrivez les missions, les objectifs et le cadre du stage..."
                                  class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition">{{ old('description') }}</textarea>
                    </div>

                    <!-- Entreprise -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-building text-purple-600 mr-2"></i>
                            Entreprise <span class="text-red-500">*</span>
                        </label>
                        <select name="entreprise_id" required 
                                class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition">
                            <option value="">Choisir une entreprise</option>
                            @foreach($entreprises as $entreprise)
                                <option value="{{ $entreprise->id }}" {{ old('entreprise_id') == $entreprise->id ? 'selected' : '' }}>
                                    {{ $entreprise->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Ville -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-map-marker-alt text-red-600 mr-2"></i>
                            Ville <span class="text-red-500">*</span>
                        </label>
                        <select name="ville_id" required 
                                class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition">
                            <option value="">Choisir une ville</option>
                            @foreach($villes as $ville)
                                <option value="{{ $ville->id }}" {{ old('ville_id') == $ville->id ? 'selected' : '' }}>
                                    {{ $ville->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Adresse exacte -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-location-dot text-gray-600 mr-2"></i>
                            Adresse exacte
                        </label>
                        <input type="text" name="adresse_exacte" value="{{ old('adresse_exacte') }}" 
                               placeholder="Ex: Immeuble Kaly, 5ème étage, Dakar"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-gray-500 focus:ring-2 focus:ring-gray-200 transition">
                    </div>

                    <!-- Durée -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-clock text-yellow-600 mr-2"></i>
                            Durée <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="duree" value="{{ old('duree') }}" required 
                               placeholder="Ex: 3 mois"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition">
                    </div>

                    <!-- Type -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-tags text-indigo-600 mr-2"></i>
                            Type de stage <span class="text-red-500">*</span>
                        </label>
                        <select name="type" required 
                                class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                            <option value="">Choisir</option>
                            <option value="technique" {{ old('type')=='technique'?'selected':'' }}>🔧 Technique</option>
                            <option value="professionnel" {{ old('type')=='professionnel'?'selected':'' }}>💼 Professionnel</option>
                            <option value="recherche" {{ old('type')=='recherche'?'selected':'' }}>🔬 Recherche</option>
                            <option value="autre" {{ old('type')=='autre'?'selected':'' }}>📌 Autre</option>
                        </select>
                    </div>

                    <!-- Date début -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-calendar-plus text-green-600 mr-2"></i>
                            Date de début <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="date_debut" value="{{ old('date_debut') }}" required 
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition">
                    </div>

                    <!-- Date fin -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-calendar-minus text-red-600 mr-2"></i>
                            Date de fin <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="date_fin" value="{{ old('date_fin') }}" required 
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition">
                    </div>

                    <!-- Date limite candidature -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-hourglass-end text-orange-600 mr-2"></i>
                            Date limite de candidature <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="date_limite_candidature" value="{{ old('date_limite_candidature') }}" required 
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition">
                    </div>

                    <!-- Nombre de postes -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-users text-blue-600 mr-2"></i>
                            Nombre de postes <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="nb_postes" value="{{ old('nb_postes', 1) }}" min="1" required 
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                    </div>

                    <!-- Rémunération -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-money-bill-wave text-green-600 mr-2"></i>
                            Rémunération
                        </label>
                        <select name="remuneration" 
                                class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition">
                            <option value="0" {{ old('remuneration')=='0'?'selected':'' }}>Non rémunéré</option>
                            <option value="1" {{ old('remuneration')=='1'?'selected':'' }}>Rémunéré</option>
                        </select>
                    </div>

                    <!-- Montant -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-coins text-yellow-600 mr-2"></i>
                            Montant (en CFA)
                        </label>
                        <input type="number" name="montant_remuneration" value="{{ old('montant_remuneration') }}" min="0" 
                               placeholder="Ex: 150000"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition">
                    </div>

                    <!-- Compétences -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-brain text-purple-600 mr-2"></i>
                            Compétences requises
                        </label>
                        <textarea name="competences_requises" rows="3" 
                                  placeholder="Ex: PHP, Laravel, MySQL, Git, travail en équipe..."
                                  class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition">{{ old('competences_requises') }}</textarea>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="flex justify-end space-x-4 border-t border-gray-200 pt-6">
                    <a href="{{ route('stages.index') }}" 
                       class="px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition flex items-center">
                        <i class="fas fa-times mr-2"></i> Annuler
                    </a>
                    <button type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:from-green-700 hover:to-green-800 transition flex items-center shadow-md hover:shadow-lg">
                        <i class="fas fa-save mr-2"></i> Publier le stage
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection