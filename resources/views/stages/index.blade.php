@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Liste des stages</h2>
    @auth
        <a href="{{ route('stages.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
            <i class="fas fa-plus mr-2"></i> Publier un stage
        </a>
    @endauth
</div>

<!-- Filtres -->
<div class="bg-white p-4 rounded-lg shadow-md mb-6">
    <form method="GET" action="{{ route('stages.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <input type="text" name="search" placeholder="Rechercher un stage..." value="{{ request('search') }}" class="border rounded px-3 py-2">
        <select name="type" class="border rounded px-3 py-2">
            <option value="">Tous types</option>
            <option value="technique" {{ request('type')=='technique'?'selected':'' }}>Technique</option>
            <option value="professionnel" {{ request('type')=='professionnel'?'selected':'' }}>Professionnel</option>
            <option value="recherche" {{ request('type')=='recherche'?'selected':'' }}>Recherche</option>
        </select>
        <select name="ville" class="border rounded px-3 py-2">
            <option value="">Toutes villes</option>
            @foreach(\App\Models\Ville::all() as $ville)
                <option value="{{ $ville->id }}" {{ request('ville')==$ville->id?'selected':'' }}>{{ $ville->nom }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            <i class="fas fa-filter"></i> Filtrer
        </button>
    </form>
</div>

<!-- Liste des stages -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($stages as $stage)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
     <img src="{{ asset('images/stage-'.($loop->index % 3 + 1).'.jpg') }}" alt="Stage"> 
            <div class="p-5">
                <h4 class="text-lg font-bold text-green-700">{{ $stage->titre }}</h4>
                <p class="text-gray-600 text-sm">{{ $stage->entreprise->nom }}</p>
                <p class="text-gray-500 text-sm mt-1"><i class="fas fa-map-marker-alt text-red-500"></i> {{ $stage->ville->nom }}</p>
                <div class="flex justify-between items-center mt-3">
                    <span class="text-sm bg-blue-100 text-blue-700 px-2 py-1 rounded">{{ $stage->type }}</span>
                    <span class="text-sm font-semibold">{{ $stage->remuneration ? $stage->montant_remuneration.' CFA' : 'Non rémunéré' }}</span>
                </div>
                <a href="{{ route('stages.show', $stage) }}" class="mt-4 inline-block text-green-600 hover:underline text-sm font-medium">Voir détails →</a>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12 text-gray-500">
            <i class="fas fa-search text-4xl mb-3"></i>
            <p>Aucun stage trouvé.</p>
        </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $stages->links() }}
</div>
@endsection