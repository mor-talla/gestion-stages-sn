<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Entreprise;
use App\Models\Candidature;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Données communes à tous
        $totalStages = Stage::count();
        $totalEntreprises = Entreprise::count();
        $totalCandidatures = Candidature::count();
        $totalEtudiants = User::where('role', 'etudiant')->count();

        // Graphiques publics
        $stagesParRegion = DB::table('stages')
            ->join('villes', 'stages.ville_id', '=', 'villes.id')
            ->join('departements', 'villes.departement_id', '=', 'departements.id')
            ->join('regions', 'departements.region_id', '=', 'regions.id')
            ->select('regions.nom as region', DB::raw('COUNT(stages.id) as total'))
            ->groupBy('regions.nom')
            ->pluck('total', 'region')
            ->toArray();

        $evolutionStages = DB::table('stages')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as mois'), DB::raw('COUNT(*) as total'))
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('mois')
            ->orderBy('mois', 'asc')
            ->pluck('total', 'mois')
            ->toArray();

        $typesStages = Stage::select('type', DB::raw('COUNT(*) as total'))
            ->groupBy('type')
            ->pluck('total', 'type')
            ->toArray();

        // Derniers stages (publics)
        $stagesRecents = Stage::with(['entreprise', 'ville'])->latest()->take(6)->get();

        // === DONNÉES SPÉCIFIQUES SELON LE RÔLE ===
        
        if ($user->role === 'admin') {
            // Admin voit tout
            $topEntreprises = Entreprise::withCount('stages')
                ->orderBy('stages_count', 'desc')
                ->take(5)
                ->get();

            $candidaturesRecentes = Candidature::with(['stage', 'user'])
                ->latest('date_candidature')
                ->take(5)
                ->get();

            $mesStages = Stage::with('entreprise')->latest()->paginate(6);
            $mesCandidatures = Candidature::with('stage')->latest()->take(5)->get();
            $totalUsers = User::count();
            $stats = [
                'total_stages' => $totalStages,
                'total_entreprises' => $totalEntreprises,
                'total_candidatures' => $totalCandidatures,
                'total_etudiants' => $totalEtudiants,
                'total_users' => $totalUsers,
            ];

        } elseif ($user->role === 'entreprise') {
    // Récupérer l'entreprise via le champ entreprise_id de l'utilisateur
    $entreprise = Entreprise::find($user->entreprise_id);
    
    if ($entreprise) {
        $mesStages = Stage::where('entreprise_id', $entreprise->id)
            ->with('ville')
            ->latest()
            ->paginate(6);
            
        $mesCandidatures = Candidature::with(['stage', 'user'])
            ->whereHas('stage', function($q) use ($entreprise) {
                $q->where('entreprise_id', $entreprise->id);
            })
            ->latest('date_candidature')
            ->take(5)
            ->get();

        $topEntreprises = Entreprise::withCount('stages')
            ->orderBy('stages_count', 'desc')
            ->take(5)
            ->get();

        $candidaturesRecentes = $mesCandidatures;
        
        $stats = [
            'mes_stages' => $mesStages->total(),
            'mes_candidatures' => $mesCandidatures->count(),
            'mon_entreprise' => $entreprise->nom,
        ];
    } else {
        // L'utilisateur n'a pas d'entreprise associée
        $mesStages = collect();
        $mesCandidatures = collect();
        $topEntreprises = collect();
        $candidaturesRecentes = collect();
        $stats = [
            'mes_stages' => 0,
            'mes_candidatures' => 0,
            'mon_entreprise' => 'Aucune entreprise associée',
        ];
    }

        } else { // Étudiant
            $mesCandidatures = Candidature::with(['stage', 'stage.entreprise'])
                ->where('user_id', $user->id)
                ->latest('date_candidature')
                ->take(5)
                ->get();

            $mesStages = Stage::with(['entreprise', 'ville'])
                ->where('statut', 'ouvert')
                ->latest()
                ->take(6)
                ->get();

            $topEntreprises = Entreprise::withCount('stages')
                ->orderBy('stages_count', 'desc')
                ->take(5)
                ->get();

            $candidaturesRecentes = $mesCandidatures;
            $stats = [
                'mes_candidatures' => $mesCandidatures->count(),
                'en_attente' => $mesCandidatures->where('statut', 'en_attente')->count(),
                'acceptees' => $mesCandidatures->where('statut', 'acceptee')->count(),
                'refusees' => $mesCandidatures->where('statut', 'refusee')->count(),
            ];
        }

        return view('dashboard', compact(
            'user',
            'totalStages',
            'totalEntreprises',
            'totalCandidatures',
            'totalEtudiants',
            'stagesParRegion',
            'evolutionStages',
            'typesStages',
            'stagesRecents',
            'topEntreprises',
            'candidaturesRecentes',
            'mesStages',
            'mesCandidatures',
            'stats'
        ));
    }
}