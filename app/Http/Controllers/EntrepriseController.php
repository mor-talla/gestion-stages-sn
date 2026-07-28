<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EntrepriseController extends Controller
{
    public function index(Request $request)
    {
        $query = Entreprise::with('ville');
        
        // Filtre recherche
        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%')
                  ->orWhere('secteur_activite', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }
        
        // Filtre secteur
        if ($request->filled('secteur')) {
            $query->where('secteur_activite', $request->secteur);
        }
        
        // Filtre ville
        if ($request->filled('ville')) {
            $query->where('ville_id', $request->ville);
        }
        
        $entreprises = $query->latest()->paginate(12);
        
        return view('entreprises.index', compact('entreprises'));
    }

    public function create()
    {
        // Vérifier les permissions
        if (!Auth::user() || (Auth::user()->role != 'admin' && Auth::user()->role != 'entreprise')) {
            abort(403, 'Vous n\'êtes pas autorisé à créer une entreprise.');
        }
        
        $villes = Ville::all();
        return view('entreprises.create', compact('villes'));
    }

    public function store(Request $request)
    {
        // Vérifier les permissions
        if (!Auth::user() || (Auth::user()->role != 'admin' && Auth::user()->role != 'entreprise')) {
            abort(403, 'Vous n\'êtes pas autorisé à créer une entreprise.');
        }
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:entreprises',
            'telephone' => 'required|string|max:20',
            'secteur_activite' => 'required|string',
            'adresse' => 'required|string',
            'ville_id' => 'required|exists:villes,id',
            'site_web' => 'nullable|url',
            'taille' => 'nullable|string',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['nom']) . '-' . uniqid();

        // Gestion du logo
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $logoPath;
        }

        $entreprise = Entreprise::create($validated);

        // Si l'utilisateur est une entreprise, l'associer à son compte
        if (Auth::user()->role == 'entreprise') {
            $user = Auth::user();
            $user->entreprise_id = $entreprise->id;
            $user->save();
        }

        return redirect()->route('entreprises.index')
            ->with('success', 'Entreprise créée avec succès !');
    }

    public function show(Entreprise $entreprise)
    {
        $entreprise->load(['ville', 'stages' => function($query) {
            $query->latest()->take(6);
        }, 'stages.ville']);
        
        return view('entreprises.show', compact('entreprise'));
    }

    public function edit(Entreprise $entreprise)
    {
        // Vérifier les permissions
        if (!Auth::user() || (Auth::user()->role != 'admin' && Auth::user()->entreprise_id != $entreprise->id)) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette entreprise.');
        }
        
        $villes = Ville::all();
        return view('entreprises.edit', compact('entreprise', 'villes'));
    }

    public function update(Request $request, Entreprise $entreprise)
    {
        // Vérifier les permissions
        if (!Auth::user() || (Auth::user()->role != 'admin' && Auth::user()->entreprise_id != $entreprise->id)) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette entreprise.');
        }
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:entreprises,email,' . $entreprise->id,
            'telephone' => 'required|string|max:20',
            'secteur_activite' => 'required|string',
            'adresse' => 'required|string',
            'ville_id' => 'required|exists:villes,id',
            'site_web' => 'nullable|url',
            'taille' => 'nullable|string',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Gestion du logo
        if ($request->hasFile('logo')) {
            // Supprimer l'ancien logo
            if ($entreprise->logo && Storage::disk('public')->exists($entreprise->logo)) {
                Storage::disk('public')->delete($entreprise->logo);
            }
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $logoPath;
        }

        $entreprise->update($validated);

        return redirect()->route('entreprises.index')
            ->with('success', 'Entreprise mise à jour !');
    }

    public function destroy(Entreprise $entreprise)
    {
        // Vérifier les permissions
        if (!Auth::user() || (Auth::user()->role != 'admin' && Auth::user()->entreprise_id != $entreprise->id)) {
            abort(403, 'Vous n\'êtes pas autorisé à supprimer cette entreprise.');
        }
        
        // Supprimer le logo
        if ($entreprise->logo && Storage::disk('public')->exists($entreprise->logo)) {
            Storage::disk('public')->delete($entreprise->logo);
        }
        
        $entreprise->delete();

        return redirect()->route('entreprises.index')
            ->with('success', 'Entreprise supprimée.');
    }
}