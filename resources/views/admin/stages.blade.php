@extends('layouts.admin')

@section('title', 'Gestion des stages - Admin')
@section('page-title', 'Stages')
@section('page-subtitle', 'Gestion des offres de stage')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <input type="text" name="search" placeholder="🔍 Rechercher un stage..." value="{{ request('search') }}"
               class="border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
        <select name="statut" class="border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
            <option value="">Tous les statuts</option>
            <option value="ouvert" {{ request('statut')=='ouvert'?'selected':'' }}>🟢 Ouvert</option>
            <option value="en_cours" {{ request('statut')=='en_cours'?'selected':'' }}>🟡 En cours</option>
            <option value="ferme" {{ request('statut')=='ferme'?'selected':'' }}>🔴 Fermé</option>
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2.5 rounded-xl hover:bg-blue-700 transition">
            <i class="fas fa-filter mr-2"></i> Filtrer
        </button>
    </form>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Titre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Entreprise</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ville</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Candidatures</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($stages as $stage)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $stage->titre }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $stage->entreprise->nom ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $stage->ville->nom ?? 'N/A' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full
                            @if($stage->statut == 'ouvert') bg-green-100 text-green-700
                            @elseif($stage->statut == 'en_cours') bg-yellow-100 text-yellow-700
                            @else bg-gray-100 text-gray-500 @endif">
                            {{ ucfirst($stage->statut) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $stage->candidatures_count ?? 0 }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('stages.show', $stage) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('stages.edit', $stage) }}" class="text-yellow-600 hover:text-yellow-800 mr-2">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('stages.destroy', $stage) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer ce stage ?')" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-briefcase text-4xl mb-3 block"></i>
                        Aucun stage trouvé
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $stages->links() }}
</div>
@endsection