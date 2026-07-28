@extends('layouts.admin')

@section('title', 'Gestion des entreprises - Admin')
@section('page-title', 'Entreprises')
@section('page-subtitle', 'Gestion des entreprises partenaires')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <input type="text" name="search" placeholder="🔍 Rechercher une entreprise..." value="{{ request('search') }}"
               class="border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
        <select name="secteur" class="border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
            <option value="">Tous les secteurs</option>
            <option value="telecom" {{ request('secteur')=='telecom'?'selected':'' }}>📡 Télécom</option>
            <option value="banque" {{ request('secteur')=='banque'?'selected':'' }}>🏦 Banque</option>
            <option value="sante" {{ request('secteur')=='sante'?'selected':'' }}>🏥 Santé</option>
            <option value="education" {{ request('secteur')=='education'?'selected':'' }}>📚 Éducation</option>
            <option value="commerce" {{ request('secteur')=='commerce'?'selected':'' }}>🛒 Commerce</option>
            <option value="industrie" {{ request('secteur')=='industrie'?'selected':'' }}>🏭 Industrie</option>
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
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Secteur</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ville</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stages</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Créée le</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($entreprises as $entreprise)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $entreprise->nom }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full
                            @if($entreprise->secteur_activite == 'telecom') bg-blue-100 text-blue-700
                            @elseif($entreprise->secteur_activite == 'banque') bg-green-100 text-green-700
                            @elseif($entreprise->secteur_activite == 'sante') bg-red-100 text-red-700
                            @elseif($entreprise->secteur_activite == 'education') bg-purple-100 text-purple-700
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ ucfirst($entreprise->secteur_activite) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $entreprise->ville->nom ?? 'N/A' }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $entreprise->stages_count ?? 0 }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $entreprise->created_at ? $entreprise->created_at->format('d/m/Y') : 'N/A' }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('entreprises.show', $entreprise) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('entreprises.edit', $entreprise) }}" class="text-yellow-600 hover:text-yellow-800 mr-2">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('entreprises.destroy', $entreprise) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer cette entreprise ?')" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-building text-4xl mb-3 block"></i>
                        Aucune entreprise trouvée
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $entreprises->links() }}
</div>
@endsection