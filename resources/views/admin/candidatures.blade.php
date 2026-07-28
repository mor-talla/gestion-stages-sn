@extends('layouts.admin')

@section('title', 'Gestion des candidatures - Admin')
@section('page-title', 'Candidatures')
@section('page-subtitle', 'Gestion des candidatures reçues')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <input type="text" name="search" placeholder="🔍 Rechercher un candidat..." value="{{ request('search') }}"
               class="border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
        <select name="statut" class="border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
            <option value="">Tous les statuts</option>
            <option value="en_attente" {{ request('statut')=='en_attente'?'selected':'' }}>⏳ En attente</option>
            <option value="acceptee" {{ request('statut')=='acceptee'?'selected':'' }}>✅ Acceptée</option>
            <option value="refusee" {{ request('statut')=='refusee'?'selected':'' }}>❌ Refusée</option>
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
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Candidat</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stage</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($candidatures as $candidature)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $candidature->nom_candidat }} {{ $candidature->prenom }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $candidature->stage->titre ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $candidature->email }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $candidature->date_candidature ? \Carbon\Carbon::parse($candidature->date_candidature)->format('d/m/Y') : 'N/A' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full
                            @if($candidature->statut == 'en_attente') bg-yellow-100 text-yellow-700
                            @elseif($candidature->statut == 'acceptee') bg-green-100 text-green-700
                            @else bg-red-100 text-red-700 @endif">
                            {{ ucfirst($candidature->statut) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('candidatures.show', $candidature) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                            <i class="fas fa-eye"></i>
                        </a>
                        @if($candidature->statut == 'en_attente')
                            <form action="{{ route('candidatures.accept', $candidature) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <button type="submit" class="text-green-600 hover:text-green-800 mr-2" onclick="return confirm('Accepter cette candidature ?')">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            <form action="{{ route('candidatures.refuse', $candidature) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Refuser cette candidature ?')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-file-signature text-4xl mb-3 block"></i>
                        Aucune candidature trouvée
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $candidatures->links() }}
</div>
@endsection