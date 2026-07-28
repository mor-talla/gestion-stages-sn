@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-green-600 via-yellow-400 to-red-600 h-2"></div>
        
        <div class="p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-paper-plane text-green-600 text-3xl mr-3"></i>
                    Postuler au stage
                </h2>
                <!-- CORRECTION ICI : utilisation de $stage->id -->
<a href="{{ route('stages.show', $stage->id) }}" class="text-gray-500 hover:text-gray-700 transition">                    <i class="fas fa-times text-xl"></i>
                </a>
            </div>

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Information du stage -->
            <div class="bg-blue-50 rounded-lg p-4 mb-6 border border-blue-200">
                <div class="flex items-start">
                    <i class="fas fa-briefcase text-blue-600 text-xl mt-1 mr-3"></i>
                    <div>
                        <h4 class="font-semibold text-gray-800">{{ $stage->titre }}</h4>
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-building mr-1"></i> {{ $stage->entreprise->nom }}
                            <span class="mx-2">•</span>
                            <i class="fas fa-map-marker-alt mr-1 text-red-500"></i> {{ $stage->ville->nom ?? 'N/A' }}
                        </p>
            <p class="text-sm text-gray-600">
    <i class="fas fa-calendar mr-1"></i> 
    {{ $stage->date_debut ? \Carbon\Carbon::parse($stage->date_debut)->format('d/m/Y') : 'N/A' }} - 
    {{ $stage->date_fin ? \Carbon\Carbon::parse($stage->date_fin)->format('d/m/Y') : 'N/A' }}
</p>
<p class="text-sm text-gray-600">
    <i class="fas fa-hourglass-end mr-1 text-orange-500"></i> 
    Date limite : {{ $stage->date_limite_candidature ? \Carbon\Carbon::parse($stage->date_limite_candidature)->format('d/m/Y') : 'N/A' }}
</p>        
                    </div>
                </div>
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

            <form method="POST" action="{{ route('candidatures.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="stage_id" value="{{ $stage->id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user text-blue-600 mr-2"></i>
                            Nom <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nom_candidat" value="{{ old('nom_candidat', Auth::user()->name ?? '') }}" required 
                               placeholder="Votre nom"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                    </div>

                    <!-- Prénom -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user text-blue-600 mr-2"></i>
                            Prénom <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="prenom" value="{{ old('prenom') }}" required 
                               placeholder="Votre prénom"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope text-yellow-600 mr-2"></i>
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email ?? '') }}" required 
                               placeholder="votre@email.sn"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition">
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-phone text-green-600 mr-2"></i>
                            Téléphone <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="telephone" value="{{ old('telephone', Auth::user()->telephone ?? '') }}" required 
                               placeholder="77 123 45 67"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition">
                    </div>

                    <!-- CV -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-file-pdf text-red-600 mr-2"></i>
                            CV <span class="text-red-500">*</span>
                            <span class="text-xs text-gray-500 font-normal">(PDF, DOC, DOCX - max 2MB)</span>
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-red-500 transition">
                            <input type="file" name="cv" accept=".pdf,.doc,.docx" id="cvInput" required class="hidden">
                            <label for="cvInput" class="cursor-pointer block">
                                <i class="fas fa-cloud-upload-alt text-4xl text-red-400 mb-2"></i>
                                <p class="text-gray-500">Cliquez pour télécharger votre CV</p>
                                <p class="text-xs text-gray-400">Formats acceptés : PDF, DOC, DOCX</p>
                            </label>
                            <div id="cvPreview" class="mt-3 hidden">
                                <div class="flex items-center justify-center space-x-2 text-green-600">
                                    <i class="fas fa-check-circle text-2xl"></i>
                                    <span id="cvFileName" class="font-medium">Fichier sélectionné</span>
                                    <button type="button" onclick="removeCV()" class="text-red-500 hover:text-red-700 ml-2">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lettre de motivation -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-align-left text-gray-600 mr-2"></i>
                            Lettre de motivation <span class="text-red-500">*</span>
                        </label>
                        <textarea name="lettre_motivation" rows="6" required 
                                  placeholder="Expliquez pourquoi vous êtes le candidat idéal pour ce stage..."
                                  class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition">{{ old('lettre_motivation') }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Minimum 100 caractères</p>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="flex justify-end space-x-4 border-t border-gray-200 pt-6">
                    <!-- CORRECTION ICI : utilisation de $stage->id -->
                    <a href="{{ route('stages.show', $stage->id) }}" 
                       class="px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Retour
                    </a>
                    <button type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:from-green-700 hover:to-green-800 transition flex items-center shadow-md hover:shadow-lg">
                        <i class="fas fa-paper-plane mr-2"></i> Envoyer ma candidature
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('cvInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            document.getElementById('cvFileName').textContent = file.name;
            document.getElementById('cvPreview').classList.remove('hidden');
            document.querySelector('label[for="cvInput"]').classList.add('hidden');
        }
    });

    function removeCV() {
        document.getElementById('cvInput').value = '';
        document.getElementById('cvPreview').classList.add('hidden');
        document.querySelector('label[for="cvInput"]').classList.remove('hidden');
    }
</script>
@endsection