<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stage;
use App\Models\Entreprise;
use App\Models\Ville;
use Illuminate\Support\Str;

class StageDateSeeder extends Seeder
{
    public function run()
    {
        $entreprises = Entreprise::all();
        $villes = Ville::all();

        if ($entreprises->isEmpty() || $villes->isEmpty()) {
            $this->command->info('Création des entreprises et villes...');
            $this->call([VilleSeeder::class, EntrepriseSeeder::class]);
            $entreprises = Entreprise::all();
            $villes = Ville::all();
        }

        $stages = [
            [
                'titre' => 'Développeur Full Stack Laravel',
                'description' => 'Stage de 6 mois pour développer des applications web avec Laravel, Vue.js et MySQL.',
                'duree' => '6 mois',
                'type' => 'technique',
                'remuneration' => true,
                'montant_remuneration' => 150000,
                'nb_postes' => 2,
                'competences_requises' => 'PHP 8+, Laravel, MySQL, Git, Vue.js',
                'adresse_exacte' => 'Dakar Plateau, Sénégal'
            ],
            [
                'titre' => 'Assistant Marketing Digital',
                'description' => 'Stage pour assister l\'équipe marketing dans la gestion des réseaux sociaux.',
                'duree' => '4 mois',
                'type' => 'professionnel',
                'remuneration' => true,
                'montant_remuneration' => 120000,
                'nb_postes' => 1,
                'competences_requises' => 'Réseaux sociaux, SEO, Google Ads',
                'adresse_exacte' => 'Almadies, Dakar'
            ],
            [
                'titre' => 'Analyste Financier Junior',
                'description' => 'Stage en finance pour analyser les données économiques.',
                'duree' => '3 mois',
                'type' => 'recherche',
                'remuneration' => false,
                'montant_remuneration' => null,
                'nb_postes' => 2,
                'competences_requises' => 'Finance, Excel, Analyse de données',
                'adresse_exacte' => 'Dakar, Sénégal'
            ],
        ];

        foreach ($stages as $data) {
            // Génère des dates aléatoires mais cohérentes
            $dateDebut = now()->addDays(rand(5, 30));
            
            Stage::create([
                'titre' => $data['titre'],
                'slug' => Str::slug($data['titre']) . '-' . uniqid(),
                'description' => $data['description'],
                'entreprise_id' => $entreprises->random()->id,
                'ville_id' => $villes->random()->id,
                'duree' => $data['duree'],
                'date_debut' => $dateDebut,
                'date_fin' => $dateDebut->copy()->addDays(rand(60, 180)),
                'date_limite_candidature' => $dateDebut->copy()->subDays(rand(5, 15)),
                'type' => $data['type'],
                'statut' => 'ouvert',
                'remuneration' => $data['remuneration'],
                'montant_remuneration' => $data['montant_remuneration'],
                'nb_postes' => $data['nb_postes'],
                'competences_requises' => $data['competences_requises'],
                'adresse_exacte' => $data['adresse_exacte'],
            ]);
        }

        $this->command->info('Stages créés avec succès !');
    }
}