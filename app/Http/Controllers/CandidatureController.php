<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CandidatureController extends Controller
{
    /**
     * Afficher la liste des candidatures
     */
    public function index()
    {
        $user = Auth::user();

        // Si c'est un admin ou une entreprise, voir toutes les candidatures
        if ($user->role === 'admin' || $user->role === 'entreprise') {
            $candidatures = Candidature::with(['stage', 'stage.entreprise', 'user'])
                ->latest('date_candidature')
                ->paginate(15);
        } else {
            // Si c'est un étudiant, voir uniquement ses candidatures
            $candidatures = Candidature::with(['stage', 'stage.entreprise'])
                ->where('user_id', $user->id)
                ->latest('date_candidature')
                ->paginate(10);
        }

        return view('candidatures.index', compact('candidatures'));
    }

    /**
     * Afficher le formulaire de candidature
     */
    public function create(Stage $stage)
    {
        // Vérifier si l'étudiant a déjà postulé à ce stage
        $existingCandidature = Candidature::where('stage_id', $stage->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingCandidature) {
            return redirect()->route('stages.show', $stage)
                ->with('error', 'Vous avez déjà postulé à ce stage.');
        }

        // Vérifier si le stage est encore ouvert
        if ($stage->statut === 'ferme') {
            return redirect()->route('stages.show', $stage)
                ->with('error', 'Ce stage est fermé. Vous ne pouvez plus postuler.');
        }

        return view('candidatures.create', compact('stage'));
    }

    /**
     * Enregistrer une nouvelle candidature
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'stage_id' => 'required|exists:stages,id',
            'nom_candidat' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'lettre_motivation' => 'required|string|min:100',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Vérifier que l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour postuler.');
        }

        // Vérifier si l'étudiant a déjà postulé
        $existing = Candidature::where('stage_id', $validated['stage_id'])
            ->where('user_id', Auth::id())
            ->first();

        if ($existing) {
            return back()->with('error', 'Vous avez déjà postulé à ce stage.');
        }

        // Vérifier si le stage est encore ouvert
        $stage = Stage::find($validated['stage_id']);
        if ($stage->statut === 'ferme') {
            return back()->with('error', 'Ce stage est fermé.');
        }

        // Gérer l'upload du CV
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        } else {
            return back()->with('error', 'Veuillez télécharger votre CV.');
        }

        // Créer la candidature
        $candidature = Candidature::create([
            'stage_id' => $validated['stage_id'],
            'user_id' => Auth::id(),
            'nom_candidat' => $validated['nom_candidat'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'lettre_motivation' => $validated['lettre_motivation'],
            'cv_path' => $cvPath,
            'statut' => 'en_attente',
            'date_candidature' => now(),
        ]);

        return redirect()->route('candidatures.index')
            ->with('success', 'Votre candidature a été envoyée avec succès !');
    }

    /**
     * Afficher le détail d'une candidature
     */
    public function show(Candidature $candidature)
    {
        $user = Auth::user();

        // Vérifier les permissions
        if ($user->role === 'etudiant' && $candidature->user_id !== $user->id) {
            abort(403, 'Vous n\'êtes pas autorisé à voir cette candidature.');
        }

        if ($user->role === 'entreprise') {
            $entrepriseId = $user->entreprise_id;
            $stageEntrepriseId = $candidature->stage->entreprise_id;
            if ($entrepriseId !== $stageEntrepriseId) {
                abort(403, 'Vous n\'êtes pas autorisé à voir cette candidature.');
            }
        }

        $candidature->load(['stage', 'stage.entreprise', 'user']);
        return view('candidatures.show', compact('candidature'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Candidature $candidature)
    {
        $user = Auth::user();

        // Seul l'étudiant peut modifier sa candidature si elle est en attente
        if ($user->role !== 'etudiant' || $candidature->user_id !== $user->id) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette candidature.');
        }

        if ($candidature->statut !== 'en_attente') {
            return back()->with('error', 'Cette candidature ne peut plus être modifiée.');
        }

        return view('candidatures.edit', compact('candidature'));
    }

    /**
     * Mettre à jour une candidature
     */
    public function update(Request $request, Candidature $candidature)
    {
        $user = Auth::user();

        if ($user->role !== 'etudiant' || $candidature->user_id !== $user->id) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette candidature.');
        }

        if ($candidature->statut !== 'en_attente') {
            return back()->with('error', 'Cette candidature ne peut plus être modifiée.');
        }

        $validated = $request->validate([
            'nom_candidat' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'lettre_motivation' => 'required|string|min:100',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Gérer l'upload du nouveau CV
        if ($request->hasFile('cv')) {
            // Supprimer l'ancien CV
            if ($candidature->cv_path && Storage::disk('public')->exists($candidature->cv_path)) {
                Storage::disk('public')->delete($candidature->cv_path);
            }
            $validated['cv_path'] = $request->file('cv')->store('cvs', 'public');
        }

        $candidature->update($validated);

        return redirect()->route('candidatures.index')
            ->with('success', 'Votre candidature a été mise à jour.');
    }

    /**
     * Accepter une candidature (admin/entreprise)
     */
    public function accept(Candidature $candidature)
    {
        $user = Auth::user();

        // Vérifier les permissions
        if ($user->role === 'admin') {
            // Admin peut tout accepter
        } elseif ($user->role === 'entreprise') {
            $entrepriseId = $user->entreprise_id;
            $stageEntrepriseId = $candidature->stage->entreprise_id;
            if ($entrepriseId !== $stageEntrepriseId) {
                abort(403, 'Vous n\'êtes pas autorisé à gérer cette candidature.');
            }
        } else {
            abort(403, 'Vous n\'êtes pas autorisé à effectuer cette action.');
        }

        if ($candidature->statut !== 'en_attente') {
            return back()->with('error', 'Cette candidature a déjà été traitée.');
        }

        $candidature->update(['statut' => 'acceptee']);

        return redirect()->route('candidatures.index')
            ->with('success', 'La candidature a été acceptée avec succès !');
    }

    /**
     * Refuser une candidature (admin/entreprise)
     */
    public function refuse(Candidature $candidature)
    {
        $user = Auth::user();

        // Vérifier les permissions
        if ($user->role === 'admin') {
            // Admin peut tout refuser
        } elseif ($user->role === 'entreprise') {
            $entrepriseId = $user->entreprise_id;
            $stageEntrepriseId = $candidature->stage->entreprise_id;
            if ($entrepriseId !== $stageEntrepriseId) {
                abort(403, 'Vous n\'êtes pas autorisé à gérer cette candidature.');
            }
        } else {
            abort(403, 'Vous n\'êtes pas autorisé à effectuer cette action.');
        }

        if ($candidature->statut !== 'en_attente') {
            return back()->with('error', 'Cette candidature a déjà été traitée.');
        }

        $candidature->update(['statut' => 'refusee']);

        return redirect()->route('candidatures.index')
            ->with('success', 'La candidature a été refusée.');
    }

    /**
     * Supprimer une candidature
     */
    public function destroy(Candidature $candidature)
    {
        $user = Auth::user();

        // Seul l'étudiant peut supprimer sa candidature si elle est en attente
        if ($user->role === 'etudiant' && $candidature->user_id === $user->id) {
            if ($candidature->statut !== 'en_attente') {
                return back()->with('error', 'Cette candidature ne peut plus être annulée.');
            }
        } elseif ($user->role !== 'admin') {
            abort(403, 'Vous n\'êtes pas autorisé à supprimer cette candidature.');
        }

        // Supprimer le CV
        if ($candidature->cv_path && Storage::disk('public')->exists($candidature->cv_path)) {
            Storage::disk('public')->delete($candidature->cv_path);
        }

        $candidature->delete();

        return redirect()->route('candidatures.index')
            ->with('success', 'La candidature a été supprimée.');
    }
}