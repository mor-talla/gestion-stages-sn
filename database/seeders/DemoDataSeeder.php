<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ville;
use App\Models\Entreprise;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Villes du Sénégal
        $villes = ['Dakar', 'Thiès', 'Saint-Louis', 'Diourbel', 'Kaolack', 'Ziguinchor', 'Tambacounda', 'Louga', 'Kolda', 'Mbour'];
        foreach ($villes as $nom) {
            Ville::create([
                'nom' => $nom,
                'slug' => Str::slug($nom),
                'departement_id' => 1 // Si vous n'avez pas de département, mettez 1 ou modifiez
            ]);
        }

        // 2. Entreprises sénégalaises
        $entreprises = [
            ['nom' => 'Sonatel S.A', 'email' => 'contact@sonatel.sn', 'telephone' => '338391000', 'secteur_activite' => 'telecom', 'adresse' => 'Route des Almadies, Dakar', 'ville_id' => 1],
            ['nom' => 'Orange Sénégal', 'email' => 'contact@orange.sn', 'telephone' => '338390000', 'secteur_activite' => 'telecom', 'adresse' => 'Immeuble Orange, Dakar', 'ville_id' => 1],
            ['nom' => 'Ecobank Sénégal', 'email' => 'contact@ecobank.sn', 'telephone' => '338399000', 'secteur_activite' => 'banque', 'adresse' => 'Place de l\'Indépendance, Dakar', 'ville_id' => 1],
            ['nom' => 'Sunu Assurances', 'email' => 'contact@sunu.sn', 'telephone' => '338398000', 'secteur_activite' => 'banque', 'adresse' => 'Rue Félix Faure, Dakar', 'ville_id' => 1],
            ['nom' => 'BTP Sénégal', 'email' => 'contact@btp.sn', 'telephone' => '338397000', 'secteur_activite' => 'industrie', 'adresse' => 'Zone industrielle, Dakar', 'ville_id' => 1],
        ];
        foreach ($entreprises as $data) {
            $data['slug'] = Str::slug($data['nom']) . '-' . uniqid();
            Entreprise::create($data);
        }

        // 3. Stages
        $stages = [
            [
                'titre' => 'Développeur Full Stack Laravel',
                'description' => 'Stage de 6 mois pour développer des applications web avec Laravel, Vue.js et MySQL.',
                'entreprise_id' => 1,
                'ville_id' => 1,
                'duree' => '6 mois',
                'type' => 'technique',
                'date_debut' => now()->addDays(30),
                'date_fin' => now()->addDays(210),
                'date_limite_candidature' => now()->addDays(15),
                'nb_postes' => 2,
                'remuneration' => 1,
                'montant_remuneration' => 150000,
                'statut' => 'ouvert'
            ],
            [
                'titre' => 'Assistant Marketing Digital',
                'description' => 'Stage pour assister l\'équipe marketing dans la gestion des réseaux sociaux et des campagnes digitales.',
                'entreprise_id' => 2,
                'ville_id' => 1,
                'duree' => '4 mois',
                'type' => 'professionnel',
                'date_debut' => now()->addDays(45),
                'date_fin' => now()->addDays(165),
                'date_limite_candidature' => now()->addDays(20),
                'nb_postes' => 1,
                'remuneration' => 1,
                'montant_remuneration' => 120000,
                'statut' => 'ouvert'
            ],
            [
                'titre' => 'Analyste Financier Junior',
                'description' => 'Stage en finance pour analyser les données économiques et préparer les rapports financiers.',
                'entreprise_id' => 3,
                'ville_id' => 1,
                'duree' => '3 mois',
                'type' => 'recherche',
                'date_debut' => now()->addDays(60),
                'date_fin' => now()->addDays(150),
                'date_limite_candidature' => now()->addDays(10),
                'nb_postes' => 2,
                'remuneration' => 0,
                'montant_remuneration' => null,
                'statut' => 'ouvert'
            ],
            [
                'titre' => 'Ingénieur Génie Civil',
                'description' => 'Stage pour participer à la supervision des chantiers de construction et à la modélisation BIM.',
                'entreprise_id' => 5,
                'ville_id' => 1,
                'duree' => '5 mois',
                'type' => 'technique',
                'date_debut' => now()->addDays(20),
                'date_fin' => now()->addDays(170),
                'date_limite_candidature' => now()->addDays(5),
                'nb_postes' => 3,
                'remuneration' => 1,
                'montant_remuneration' => 180000,
                'statut' => 'en_cours'
            ],
            [
                'titre' => 'Assistant RH',
                'description' => 'Stage pour soutenir le service RH dans le recrutement et la gestion des dossiers du personnel.',
                'entreprise_id' => 4,
                'ville_id' => 1,
                'duree' => '4 mois',
                'type' => 'professionnel',
                'date_debut' => now()->addDays(50),
                'date_fin' => now()->addDays(170),
                'date_limite_candidature' => now()->addDays(25),
                'nb_postes' => 1,
                'remuneration' => 0,
                'montant_remuneration' => null,
                'statut' => 'ouvert'
            ],
        ];
        foreach ($stages as $data) {
            $data['slug'] = Str::slug($data['titre']) . '-' . uniqid();
            Stage::create($data);
        }

        // 4. Créer un admin par défaut (si ce n'est pas déjà fait)
        User::create([
            'name' => 'Admin Gestion Stages',
            'email' => 'admin@gestionstages.sn',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'telephone' => '771234567',
            'adresse' => 'Dakar, Sénégal',
        ]);
    }
}