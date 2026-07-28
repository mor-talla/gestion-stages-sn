@extends('layouts.admin')

@section('title', 'Gestion des utilisateurs - Admin')
@section('page-title', 'Utilisateurs')
@section('page-subtitle', 'Gestion des comptes')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <input type="text" name="search" placeholder="🔍 Rechercher par nom ou email..." value="{{ request('search') }}"
               class="border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
        <select name="role" class="border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
            <option value="">Tous les rôles</option>
            <option value="etudiant" {{ request('role')=='etudiant'?'selected':'' }}>🎓 Étudiant</option>
            <option value="entreprise" {{ request('role')=='entreprise'?'selected':'' }}>🏢 Entreprise</option>
            <option value="admin" {{ request('role')=='admin'?'selected':'' }}>👑 Admin</option>
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
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rôle</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Téléphone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Inscrit le</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($users as $user)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $user->name }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full
                            @if($user->role == 'admin') bg-yellow-100 text-yellow-700
                            @elseif($user->role == 'entreprise') bg-blue-100 text-blue-700
                            @else bg-green-100 text-green-700 @endif">
                            @if($user->role == 'admin') 👑 Admin
                            @elseif($user->role == 'entreprise') 🏢 Entreprise
                            @else 🎓 Étudiant @endif
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $user->telephone ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-800 mr-3">
                            <i class="fas fa-edit"></i>
                        </a>
                        @if(auth()->id() !== $user->id)
                            <form action="{{ route('admin.users.delete', $user) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Supprimer cet utilisateur ?')" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-users text-4xl mb-3 block"></i>
                        Aucun utilisateur trouvé
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $users->links() }}
</div>
@endsection