<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Entreprise;
use App\Models\Ville;
use Illuminate\Http\Request;

class StageController extends Controller
{
    public function index()
    {
        $stages = Stage::with('entreprise', 'ville')->latest()->paginate(12);
        return view('stages.index', compact('stages'));
    }

    public function create()
{
    $entreprises = Entreprise::all();
    $villes = Ville::all();
    return view('stages.create', compact('entreprises', 'villes'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required',
            'entreprise_id' => 'required|exists:entreprises,id',
            'ville_id' => 'required|exists:villes,id',
            'duree' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'type' => 'required|in:technique,professionnel,recherche,autre',
            'date_limite_candidature' => 'required|date|after:today',
            'remuneration' => 'nullable|boolean',
            'montant_remuneration' => 'nullable|numeric|min:0',
            'nb_postes' => 'required|integer|min:1',
        ]);
        $validated['slug'] = \Str::slug($validated['titre']) . '-' . uniqid();
        $validated['statut'] = 'ouvert';
        Stage::create($validated);
        return redirect()->route('stages.index')->with('success', 'Stage créé avec succès !');
    }

    public function show(Stage $stage)
    {
        $stage->load('entreprise', 'ville', 'candidatures');
        return view('stages.show', compact('stage'));
    }

    public function edit(Stage $stage)
    {
        $entreprises = Entreprise::all();
        $villes = Ville::all();
        return view('stages.edit', compact('stage', 'entreprises', 'villes'));
    }

    public function update(Request $request, Stage $stage)
{
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required',
        'entreprise_id' => 'required|exists:entreprises,id',
        'ville_id' => 'required|exists:villes,id',
        'duree' => 'required|string|max:50',
        'date_debut' => 'required|date|after_or_equal:today',
        'date_fin' => 'required|date|after:date_debut',
        'date_limite_candidature' => 'required|date|before:date_debut|after_or_equal:today',
        'type' => 'required|in:technique,professionnel,recherche,autre',
        'statut' => 'required|in:ouvert,en_cours,ferme',
        'remuneration' => 'nullable|boolean',
        'montant_remuneration' => 'nullable|numeric|min:0',
        'nb_postes' => 'required|integer|min:1',
        'competences_requises' => 'nullable|string',
        'adresse_exacte' => 'nullable|string',
    ]);

    // Si non rémunéré, on met le montant à null
    if (!$request->has('remuneration') || $request->remuneration == 0) {
        $validated['montant_remuneration'] = null;
    }

    $stage->update($validated);

    return redirect()->route('stages.index')->with('success', 'Stage mis à jour avec succès !');
}

    public function destroy(Stage $stage)
    {
        $stage->delete();
        return redirect()->route('stages.index')->with('success', 'Stage supprimé.');
    }
}