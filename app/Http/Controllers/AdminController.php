<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Entreprise;
use App\Models\Stage;
use App\Models\Candidature;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Tableau de bord Admin
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_etudiants' => User::where('role', 'etudiant')->count(),
            'total_entreprises' => User::where('role', 'entreprise')->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_stages' => Stage::count(),
            'total_entreprises_partenaires' => Entreprise::count(),
            'total_candidatures' => Candidature::count(),
            'candidatures_en_attente' => Candidature::where('statut', 'en_attente')->count(),
            'candidatures_acceptees' => Candidature::where('statut', 'acceptee')->count(),
            'candidatures_refusees' => Candidature::where('statut', 'refusee')->count(),
            'stages_ouverts' => Stage::where('statut', 'ouvert')->count(),
            'stages_fermes' => Stage::where('statut', 'ferme')->count(),
            'stages_en_cours' => Stage::where('statut', 'en_cours')->count(),
        ];

        $derniersUtilisateurs = User::latest()->take(5)->get();
        $derniersStages = Stage::with('entreprise', 'ville')->latest()->take(5)->get();
        $dernieresCandidatures = Candidature::with('stage', 'user')->latest('date_candidature')->take(5)->get();
        $topEntreprises = Entreprise::withCount('stages')->orderBy('stages_count', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'stats',
            'derniersUtilisateurs',
            'derniersStages',
            'dernieresCandidatures',
            'topEntreprises'
        ));
    }

    /**
     * Gestion des utilisateurs
     */
    public function users(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    /**
     * Formulaire d'édition d'un utilisateur
     */
    public function editUser(User $user)
    {
        return view('admin.users-edit', compact('user'));
    }

    /**
     * Mettre à jour un utilisateur
     */
    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:500',
            'role' => 'required|in:etudiant,entreprise,admin',
        ]);

        if ($user->role === 'admin' && $validated['role'] !== 'admin') {
            $adminCount = User::where('role', 'admin')->count();
            if ($adminCount <= 1) {
                return back()->with('error', 'Il doit y avoir au moins un administrateur.');
            }
        }

        $user->update($validated);
        return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Supprimer un utilisateur
     */
    public function deleteUser(User $user)
    {
        if ($user->role === 'admin') {
            $adminCount = User::where('role', 'admin')->count();
            if ($adminCount <= 1) {
                return back()->with('error', 'Impossible de supprimer le dernier administrateur.');
            }
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé avec succès.');
    }

    /**
     * Gestion des entreprises (admin)
     */
    public function entreprises(Request $request)
    {
        $query = Entreprise::with('ville');

        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%')
                  ->orWhere('secteur_activite', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('secteur')) {
            $query->where('secteur_activite', $request->secteur);
        }

        $entreprises = $query->latest()->paginate(12);
        
        // Récupérer les villes pour le filtre
        $villes = Ville::orderBy('nom')->get();
        
        return view('admin.entreprises', compact('entreprises', 'villes'));
    }

    /**
     * Formulaire de création d'une entreprise
     */
    public function createEntreprise()
    {
        $villes = Ville::orderBy('nom')->get();
        return view('admin.entreprises-create', compact('villes'));
    }

    /**
     * Créer une entreprise (admin uniquement)
     */
    public function storeEntreprise(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|unique:entreprises,email',
            'password' => 'required|string|min:8',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string',
            'ville_id' => 'required|exists:villes,id',
            'secteur_activite' => 'required|string',
            'taille' => 'nullable|string',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        // 1. Créer l'utilisateur
        $user = User::create([
            'name' => $validated['nom'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'entreprise',
            'telephone' => $validated['telephone'],
            'adresse' => $validated['adresse'],
        ]);

        // 2. Créer l'entreprise
        $entreprise = Entreprise::create([
            'nom' => $validated['nom'],
            'slug' => Str::slug($validated['nom']) . '-' . uniqid(),
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'adresse' => $validated['adresse'],
            'ville_id' => $validated['ville_id'],
            'secteur_activite' => $validated['secteur_activite'],
            'taille' => $validated['taille'],
            'description' => $validated['description'],
        ]);

        // 3. Lier l'utilisateur à l'entreprise
        $user->entreprise_id = $entreprise->id;
        $user->save();

        return redirect()->route('admin.entreprises')->with('success', 'Entreprise créée avec succès !');
    }

    /**
     * Gestion des stages (admin)
     */
    public function stages(Request $request)
    {
        $query = Stage::with('entreprise', 'ville');

        if ($request->filled('search')) {
            $query->where('titre', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $stages = $query->latest()->paginate(12);
        return view('admin.stages', compact('stages'));
    }

    /**
     * Gestion des candidatures (admin)
     */
    public function candidatures(Request $request)
    {
        $query = Candidature::with('stage', 'user');

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('search')) {
            $query->where('nom_candidat', 'like', '%' . $request->search . '%')
                  ->orWhere('prenom', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $candidatures = $query->latest('date_candidature')->paginate(15);
        return view('admin.candidatures', compact('candidatures'));
    }
}