@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Bandeau drapeau -->
        <div class="bg-gradient-to-r from-green-600 via-yellow-400 to-red-600 h-2"></div>
        
        <div class="p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-edit text-blue-600 text-3xl mr-3"></i>
                    Modifier l'entreprise
                </h2>
                <a href="{{ route('entreprises.index') }}" class="text-gray-500 hover:text-gray-700 transition">
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

            <form method="POST" action="{{ route('entreprises.update', $entreprise) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-building text-green-600 mr-2"></i>
                            Nom de l'entreprise <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nom" value="{{ old('nom', $entreprise->nom) }}" required 
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition">
                        @error('nom')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope text-blue-600 mr-2"></i>
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email', $entreprise->email) }}" required 
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-phone text-yellow-600 mr-2"></i>
                            Téléphone <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="telephone" value="{{ old('telephone', $entreprise->telephone) }}" required 
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition">
                        @error('telephone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Secteur -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-tag text-purple-600 mr-2"></i>
                            Secteur d'activité <span class="text-red-500">*</span>
                        </label>
                        <select name="secteur_activite" required 
                                class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition">
                            <option value="">Choisir un secteur</option>
                            <option value="telecom" {{ old('secteur_activite', $entreprise->secteur_activite) == 'telecom' ? 'selected' : '' }}>📡 Télécommunications</option>
                            <option value="banque" {{ old('secteur_activite', $entreprise->secteur_activite) == 'banque' ? 'selected' : '' }}>🏦 Banque & Finance</option>
                            <option value="sante" {{ old('secteur_activite', $entreprise->secteur_activite) == 'sante' ? 'selected' : '' }}>🏥 Santé</option>
                            <option value="education" {{ old('secteur_activite', $entreprise->secteur_activite) == 'education' ? 'selected' : '' }}>📚 Éducation</option>
                            <option value="agriculture" {{ old('secteur_activite', $entreprise->secteur_activite) == 'agriculture' ? 'selected' : '' }}>🌾 Agriculture</option>
                            <option value="commerce" {{ old('secteur_activite', $entreprise->secteur_activite) == 'commerce' ? 'selected' : '' }}>🛒 Commerce</option>
                            <option value="industrie" {{ old('secteur_activite', $entreprise->secteur_activite) == 'industrie' ? 'selected' : '' }}>🏭 Industrie</option>
                            <option value="tech" {{ old('secteur_activite', $entreprise->secteur_activite) == 'tech' ? 'selected' : '' }}>💻 Technologies</option>
                            <option value="transport" {{ old('secteur_activite', $entreprise->secteur_activite) == 'transport' ? 'selected' : '' }}>🚚 Transport</option>
                            <option value="hotellerie" {{ old('secteur_activite', $entreprise->secteur_activite) == 'hotellerie' ? 'selected' : '' }}>🏨 Hôtellerie</option>
                            <option value="agroalimentaire" {{ old('secteur_activite', $entreprise->secteur_activite) == 'agroalimentaire' ? 'selected' : '' }}>🌽 Agroalimentaire</option>
                        </select>
                        @error('secteur_activite')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Adresse -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-map-marker-alt text-red-600 mr-2"></i>
                            Adresse <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="adresse" value="{{ old('adresse', $entreprise->adresse) }}" required 
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition">
                        @error('adresse')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ville -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-city text-indigo-600 mr-2"></i>
                            Ville <span class="text-red-500">*</span>
                        </label>
                        <select name="ville_id" required 
                                class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                            <option value="">Choisir une ville</option>
                            @foreach($villes as $ville)
                                <option value="{{ $ville->id }}" {{ old('ville_id', $entreprise->ville_id) == $ville->id ? 'selected' : '' }}>
                                    {{ $ville->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('ville_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Site Web -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-globe text-blue-600 mr-2"></i>
                            Site Web
                        </label>
                        <input type="url" name="site_web" value="{{ old('site_web', $entreprise->site_web) }}" 
                               placeholder="https://www.entreprise.sn"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                        @error('site_web')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Taille -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-users text-gray-600 mr-2"></i>
                            Taille de l'entreprise
                        </label>
                        <select name="taille" 
                                class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-gray-500 focus:ring-2 focus:ring-gray-200 transition">
                            <option value="">Choisir</option>
                            <option value="1-10" {{ old('taille', $entreprise->taille) == '1-10' ? 'selected' : '' }}>1-10 employés</option>
                            <option value="11-50" {{ old('taille', $entreprise->taille) == '11-50' ? 'selected' : '' }}>11-50 employés</option>
                            <option value="51-200" {{ old('taille', $entreprise->taille) == '51-200' ? 'selected' : '' }}>51-200 employés</option>
                            <option value="201-1000" {{ old('taille', $entreprise->taille) == '201-1000' ? 'selected' : '' }}>201-1000 employés</option>
                            <option value="1000+" {{ old('taille', $entreprise->taille) == '1000+' ? 'selected' : '' }}>1000+ employés</option>
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-align-left text-gray-600 mr-2"></i>
                            Description
                        </label>
                        <textarea name="description" rows="4" 
                                  class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition">{{ old('description', $entreprise->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Logo -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-image text-pink-600 mr-2"></i>
                            Logo de l'entreprise
                        </label>
                        @if($entreprise->logo)
                            <div class="mb-3">
                                <p class="text-sm text-gray-500 mb-2">Logo actuel :</p>
                                <img src="{{ asset('storage/'.$entreprise->logo) }}" alt="Logo" class="h-20 w-20 object-cover rounded-full border-2 border-green-500">
                            </div>
                        @endif
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-green-500 transition">
                            <input type="file" name="logo" accept="image/*" id="logoInput" class="hidden">
                            <label for="logoInput" class="cursor-pointer block">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <p class="text-gray-500">Cliquez pour modifier le logo</p>
                                <p class="text-xs text-gray-400">PNG, JPG, SVG (max 2MB)</p>
                            </label>
                            <div id="logoPreview" class="mt-3 hidden">
                                <img id="logoPreviewImage" src="#" alt="Aperçu" class="h-24 w-24 object-cover rounded-full mx-auto border-2 border-green-500">
                                <button type="button" onclick="removeLogo()" class="text-red-500 text-sm mt-2 hover:underline">
                                    <i class="fas fa-times"></i> Supprimer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="flex justify-end space-x-4 border-t border-gray-200 pt-6">
                    <a href="{{ route('entreprises.index') }}" 
                       class="px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition flex items-center">
                        <i class="fas fa-times mr-2"></i> Annuler
                    </a>
                    <button type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition flex items-center shadow-md hover:shadow-lg">
                        <i class="fas fa-save mr-2"></i> Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('logoInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('logoPreviewImage').src = e.target.result;
                document.getElementById('logoPreview').classList.remove('hidden');
                document.querySelector('label[for="logoInput"]').classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    function removeLogo() {
        document.getElementById('logoInput').value = '';
        document.getElementById('logoPreview').classList.add('hidden');
        document.querySelector('label[for="logoInput"]').classList.remove('hidden');
    }
</script>
@endsection