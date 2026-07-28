<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entreprise;
use App\Models\Ville;
use Illuminate\Support\Str;

class EntrepriseSeeder extends Seeder
{
    public function run()
    {
        $villes = Ville::all();
        
        if ($villes->isEmpty()) {
            // Créer quelques villes si elles n'existent pas
            $villes = [
                ['nom' => 'Dakar', 'slug' => 'dakar'],
                ['nom' => 'Thiès', 'slug' => 'thies'],
                ['nom' => 'Saint-Louis', 'slug' => 'saint-louis'],
                ['nom' => 'Kaolack', 'slug' => 'kaolack'],
                ['nom' => 'Ziguinchor', 'slug' => 'ziguinchor'],
                ['nom' => 'Mbour', 'slug' => 'mbour'],
                ['nom' => 'Louga', 'slug' => 'louga'],
                ['nom' => 'Tambacounda', 'slug' => 'tambacounda'],
                ['nom' => 'Diourbel', 'slug' => 'diourbel'],
                ['nom' => 'Kolda', 'slug' => 'kolda'],
            ];
            
            foreach ($villes as $ville) {
                \App\Models\Ville::create($ville);
            }
            $villes = \App\Models\Ville::all();
        }

        $entreprises = [
            [
                'nom' => 'Sonatel S.A',
                'secteur_activite' => 'telecom',
                'email' => 'contact@sonatel.sn',
                'telephone' => '338391000',
                'adresse' => 'Route des Almadies, Dakar',
                'site_web' => 'https://www.sonatel.sn',
                'taille' => '1000+',
                'description' => 'Leader des télécommunications au Sénégal et en Afrique de l\'Ouest. Sonatel propose des solutions innovantes pour connecter les Sénégalais.',
            ],
            [
                'nom' => 'Orange Sénégal',
                'secteur_activite' => 'telecom',
                'email' => 'contact@orange.sn',
                'telephone' => '338390000',
                'adresse' => 'Immeuble Orange, Dakar',
                'site_web' => 'https://www.orange.sn',
                'taille' => '1000+',
                'description' => 'Opérateur de téléphonie mobile et internet de référence au Sénégal. Orange connecte les Sénégalais à travers tout le pays.',
            ],
            [
                'nom' => 'Ecobank Sénégal',
                'secteur_activite' => 'banque',
                'email' => 'contact@ecobank.sn',
                'telephone' => '338399000',
                'adresse' => 'Place de l\'Indépendance, Dakar',
                'site_web' => 'https://www.ecobank.com',
                'taille' => '500+',
                'description' => 'Banque panafricaine de premier plan présente dans plus de 30 pays. Ecobank propose des solutions financières innovantes.',
            ],
            [
                'nom' => 'Sunu Assurances',
                'secteur_activite' => 'banque',
                'email' => 'contact@sunu.sn',
                'telephone' => '338398000',
                'adresse' => 'Rue Félix Faure, Dakar',
                'site_web' => 'https://www.sunugroup.com',
                'taille' => '500+',
                'description' => 'Groupe d\'assurances leader en Afrique de l\'Ouest. Sunu protège les Sénégalais depuis plus de 50 ans.',
            ],
            [
                'nom' => 'TIGO Sénégal',
                'secteur_activite' => 'telecom',
                'email' => 'contact@tigo.sn',
                'telephone' => '338397000',
                'adresse' => 'Zone Aéroport, Dakar',
                'site_web' => 'https://www.tigo.sn',
                'taille' => '500+',
                'description' => 'Opérateur de téléphonie mobile et services digitaux. Tigo propose des solutions innovantes pour les Sénégalais.',
            ],
            [
                'nom' => 'Free Sénégal',
                'secteur_activite' => 'telecom',
                'email' => 'contact@free.sn',
                'telephone' => '338396000',
                'adresse' => 'Immeuble Free, Dakar',
                'site_web' => 'https://www.free.sn',
                'taille' => '200+',
                'description' => 'Opérateur de téléphonie mobile et internet à bas prix. Free révolutionne le marché des télécommunications au Sénégal.',
            ],
            [
                'nom' => 'TotalEnergies Sénégal',
                'secteur_activite' => 'industrie',
                'email' => 'contact@total.sn',
                'telephone' => '338395000',
                'adresse' => 'Boulevard de la République, Dakar',
                'site_web' => 'https://www.total.sn',
                'taille' => '500+',
                'description' => 'Groupe énergétique leader au Sénégal. TotalEnergies distribue des carburants, lubrifiants et solutions énergétiques.',
            ],
            [
                'nom' => 'Axa Sénégal',
                'secteur_activite' => 'banque',
                'email' => 'contact@axa.sn',
                'telephone' => '338394000',
                'adresse' => 'Rue Malenfant, Dakar',
                'site_web' => 'https://www.axa.sn',
                'taille' => '200+',
                'description' => 'Groupe d\'assurances international présent au Sénégal. Axa propose des solutions d\'assurance vie et non-vie.',
            ],
            [
                'nom' => 'Nestlé Sénégal',
                'secteur_activite' => 'commerce',
                'email' => 'contact@nestle.sn',
                'telephone' => '338393000',
                'adresse' => 'Zone industrielle, Dakar',
                'site_web' => 'https://www.nestle.sn',
                'taille' => '200+',
                'description' => 'Groupe agroalimentaire mondial présent au Sénégal. Nestlé fabrique des produits alimentaires de qualité.',
            ],
            [
                'nom' => 'Coca-Cola Sénégal',
                'secteur_activite' => 'commerce',
                'email' => 'contact@cocacola.sn',
                'telephone' => '338392000',
                'adresse' => 'Zone industrielle, Dakar',
                'site_web' => 'https://www.coca-cola.com',
                'taille' => '100+',
                'description' => 'Leader des boissons gazeuses au Sénégal. Coca-Cola rafraîchit les Sénégalais depuis des décennies.',
            ],
        ];

        $villeIds = $villes->pluck('id')->toArray();

        foreach ($entreprises as $data) {
            $data['slug'] = Str::slug($data['nom']) . '-' . uniqid();
            $data['ville_id'] = $villeIds[array_rand($villeIds)];
            Entreprise::create($data);
        }

        $this->command->info('10 entreprises ajoutées avec succès !');
    }
}