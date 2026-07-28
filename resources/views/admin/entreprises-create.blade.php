@extends('layouts.admin')

@section('title', 'Créer une entreprise - Admin')
@section('page-title', 'Créer une entreprise')
@section('page-subtitle', 'Ajouter une nouvelle entreprise partenaire')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form method="POST" action="{{ route('admin.entreprises.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nom -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom de l'entreprise *</label>
                    <input type="text" name="nom" value="{{ old('nom') }}" required 
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required 
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                </div>

                <!-- Mot de passe -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe *</label>
                    <input type="password" name="password" required 
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                </div>

                <!-- Téléphone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone *</label>
                    <input type="text" name="telephone" value="{{ old('telephone') }}" required 
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                </div>

                <!-- Secteur -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Secteur d'activité *</label>
                    <select name="secteur_activite" required 
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                        <option value="">Choisir</option>
                        <option value="telecom" {{ old('secteur_activite')=='telecom'?'selected':'' }}>📡 Télécommunications</option>
                        <option value="banque" {{ old('secteur_activite')=='banque'?'selected':'' }}>🏦 Banque & Finance</option>
                        <option value="sante" {{ old('secteur_activite')=='sante'?'selected':'' }}>🏥 Santé</option>
                        <option value="education" {{ old('secteur_activite')=='education'?'selected':'' }}>📚 Éducation</option>
                        <option value="agriculture" {{ old('secteur_activite')=='agriculture'?'selected':'' }}>🌾 Agriculture</option>
                        <option value="commerce" {{ old('secteur_activite')=='commerce'?'selected':'' }}>🛒 Commerce</option>
                        <option value="industrie" {{ old('secteur_activite')=='industrie'?'selected':'' }}>🏭 Industrie</option>
                    </select>
                </div>

                <!-- Ville -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ville *</label>
                    <select name="ville_id" required 
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                        <option value="">Choisir une ville</option>
                        @foreach($villes as $ville)
                            <option value="{{ $ville->id }}" {{ old('ville_id')==$ville->id?'selected':'' }}>{{ $ville->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Adresse -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Adresse *</label>
                    <input type="text" name="adresse" value="{{ old('adresse') }}" required 
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                </div>

                <!-- Taille -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Taille</label>
                    <select name="taille" 
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                        <option value="">Choisir</option>
                        <option value="1-10" {{ old('taille')=='1-10'?'selected':'' }}>1-10 employés</option>
                        <option value="11-50" {{ old('taille')=='11-50'?'selected':'' }}>11-50 employés</option>
                        <option value="51-200" {{ old('taille')=='51-200'?'selected':'' }}>51-200 employés</option>
                        <option value="201-1000" {{ old('taille')=='201-1000'?'selected':'' }}>201-1000 employés</option>
                        <option value="1000+" {{ old('taille')=='1000+'?'selected':'' }}>1000+ employés</option>
                    </select>
                </div>

                <!-- Logo -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                    <input type="file" name="logo" accept="image/*" 
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="4" 
                              class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.entreprises') }}" class="px-6 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl hover:from-green-700 hover:to-green-800 transition shadow-sm hover:shadow-md">
                    <i class="fas fa-save mr-2"></i> Créer l'entreprise
                </button>
            </div>
        </form>
    </div>
</div>
@endsection