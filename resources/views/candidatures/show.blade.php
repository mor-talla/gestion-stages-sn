@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-green-600 via-yellow-400 to-red-600 h-2"></div>
        
        <div class="p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-file-signature text-blue-600 text-3xl mr-3"></i>
                    Détail de la candidature
                </h2>
                <a href="{{ route('candidatures.index') }}" class="text-gray-500 hover:text-gray-700 transition">
                    <i class="fas fa-times text-xl"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-xs text-gray-500 font-semibold uppercase">Candidat</p>
                    <p class="font-semibold text-gray-800">{{ $candidature->nom_candidat }} {{ $candidature->prenom }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-xs text-gray-500 font-semibold uppercase">Email</p>
                    <p class="font-semibold text-gray-800">{{ $candidature->email }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-xs text-gray-500 font-semibold uppercase">Téléphone</p>
                    <p class="font-semibold text-gray-800">{{ $candidature->telephone }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-xs text-gray-500 font-semibold uppercase">Date de candidature</p>
<p class="font-semibold text-gray-800">{{ $candidature->date_candidature ? \Carbon\Carbon::parse($candidature->date_candidature)->format('d/m/Y H:i') : 'N/A' }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-xs text-gray-500 font-semibold uppercase">Stage</p>
                    <p class="font-semibold text-gray-800">{{ $candidature->stage->titre ?? 'N/A' }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-xs text-gray-500 font-semibold uppercase">Statut</p>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        @if($candidature->statut == 'en_attente') bg-yellow-100 text-yellow-700
                        @elseif($candidature->statut == 'acceptee') bg-green-100 text-green-700
                        @else bg-red-100 text-red-700 @endif">
                        {{ ucfirst($candidature->statut) }}
                    </span>
                </div>
            </div>

            <!-- Lettre de motivation -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-700 flex items-center">
                    <i class="fas fa-align-left text-gray-500 mr-2"></i>
                    Lettre de motivation
                </h3>
                <div class="mt-3 bg-gray-50 p-5 rounded-xl border border-gray-100">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $candidature->lettre_motivation }}</p>
                </div>
            </div>

            <!-- CV -->
            @if($candidature->cv_path)
                <div class="mt-4">
                    <a href="{{ asset('storage/'.$candidature->cv_path) }}" target="_blank" 
                       class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm">
                        <i class="fas fa-file-pdf mr-2"></i> Voir le CV
                    </a>
                </div>
            @endif

            <!-- Actions pour admin/entreprise -->
            @auth
                @if(Auth::user()->role == 'admin' || (Auth::user()->role == 'entreprise' && Auth::user()->entreprise_id == $candidature->stage->entreprise_id))
                    <div class="mt-8 border-t border-gray-200 pt-6 flex flex-wrap gap-4">
                        @if($candidature->statut == 'en_attente')
                            <form action="{{ route('candidatures.accept', $candidature) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <button type="submit" 
                                        class="px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center shadow-md hover:shadow-lg"
                                        onclick="return confirm('Accepter cette candidature ?')">
                                    <i class="fas fa-check mr-2"></i> Accepter
                                </button>
                            </form>
                            <form action="{{ route('candidatures.refuse', $candidature) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <button type="submit" 
                                        class="px-6 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center shadow-md hover:shadow-lg"
                                        onclick="return confirm('Refuser cette candidature ?')">
                                    <i class="fas fa-times mr-2"></i> Refuser
                                </button>
                            </form>
                        @else
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-2"></i>
                                Cette candidature a déjà été traitée.
                            </span>
                            @if($candidature->statut == 'acceptee')
                                <span class="text-sm text-green-600 font-semibold">✅ Acceptée</span>
                            @else
                                <span class="text-sm text-red-600 font-semibold">❌ Refusée</span>
                            @endif
                        @endif
                    </div>
                @endif
            @endauth

            <div class="mt-6 border-t border-gray-200 pt-6">
                <a href="{{ route('candidatures.index') }}" class="text-gray-600 hover:text-gray-800 transition flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
                </a>
            </div>
        </div>
    </div>
</div>
@endsection