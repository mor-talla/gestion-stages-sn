<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🌍 Début du seeding...');

        // ============================================
        // 1. RÉGIONS (avec vérification)
        // ============================================
        $this->command->info('📌 Régions...');
        $regions = [];
        $regionsData = ['Dakar', 'Thiès', 'Saint-Louis', 'Diourbel', 'Fatick', 'Kaffrine', 'Kaolack', 'Kédougou', 'Kolda', 'Louga', 'Matam', 'Sédhiou', 'Tambacounda', 'Ziguinchor'];
        
        foreach ($regionsData as $nom) {
            $slug = Str::slug($nom);
            // Vérifier si la région existe déjà
            $existing = DB::table('regions')->where('slug', $slug)->first();
            if ($existing) {
                $regions[$nom] = $existing->id;
            } else {
                $id = DB::table('regions')->insertGetId([
                    'nom' => $nom,
                    'slug' => $slug,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $regions[$nom] = $id;
            }
        }
        $this->command->info('✅ ' . count($regions) . ' régions');

        // ============================================
        // 2. DÉPARTEMENTS (avec vérification)
        // ============================================
        $this->command->info('📌 Départements...');
        $departements = [];
        $departementsData = [
            // Dakar
            ['nom' => 'Dakar', 'region' => 'Dakar'],
            ['nom' => 'Pikine', 'region' => 'Dakar'],
            ['nom' => 'Guédiawaye', 'region' => 'Dakar'],
            ['nom' => 'Rufisque', 'region' => 'Dakar'],
            ['nom' => 'Keur Massar', 'region' => 'Dakar'],
            // Thiès
            ['nom' => 'Thiès', 'region' => 'Thiès'],
            ['nom' => 'Mbour', 'region' => 'Thiès'],
            ['nom' => 'Tivaouane', 'region' => 'Thiès'],
            // Saint-Louis
            ['nom' => 'Saint-Louis', 'region' => 'Saint-Louis'],
            ['nom' => 'Dagana', 'region' => 'Saint-Louis'],
            ['nom' => 'Podor', 'region' => 'Saint-Louis'],
            // Diourbel
            ['nom' => 'Diourbel', 'region' => 'Diourbel'],
            ['nom' => 'Bambey', 'region' => 'Diourbel'],
            ['nom' => 'Mbacké', 'region' => 'Diourbel'],
            // Fatick
            ['nom' => 'Fatick', 'region' => 'Fatick'],
            ['nom' => 'Foundiougne', 'region' => 'Fatick'],
            ['nom' => 'Gossas', 'region' => 'Fatick'],
            // Kaffrine
            ['nom' => 'Kaffrine', 'region' => 'Kaffrine'],
            ['nom' => 'Birkelane', 'region' => 'Kaffrine'],
            ['nom' => 'Koungheul', 'region' => 'Kaffrine'],
            ['nom' => 'Malem-Hodar', 'region' => 'Kaffrine'],
            // Kaolack
            ['nom' => 'Kaolack', 'region' => 'Kaolack'],
            ['nom' => 'Nioro du Rip', 'region' => 'Kaolack'],
            ['nom' => 'Guinguinéo', 'region' => 'Kaolack'],
            // Kédougou
            ['nom' => 'Kédougou', 'region' => 'Kédougou'],
            ['nom' => 'Salemata', 'region' => 'Kédougou'],
            ['nom' => 'Saraya', 'region' => 'Kédougou'],
            // Kolda
            ['nom' => 'Kolda', 'region' => 'Kolda'],
            ['nom' => 'Vélingara', 'region' => 'Kolda'],
            ['nom' => 'Médina Yoro Foulah', 'region' => 'Kolda'],
            // Louga
            ['nom' => 'Louga', 'region' => 'Louga'],
            ['nom' => 'Kébémer', 'region' => 'Louga'],
            ['nom' => 'Linguère', 'region' => 'Louga'],
            // Matam
            ['nom' => 'Matam', 'region' => 'Matam'],
            ['nom' => 'Kanel', 'region' => 'Matam'],
            ['nom' => 'Ranérou', 'region' => 'Matam'],
            // Sédhiou
            ['nom' => 'Sédhiou', 'region' => 'Sédhiou'],
            ['nom' => 'Bounkiling', 'region' => 'Sédhiou'],
            ['nom' => 'Goudomp', 'region' => 'Sédhiou'],
            // Tambacounda
            ['nom' => 'Tambacounda', 'region' => 'Tambacounda'],
            ['nom' => 'Bakel', 'region' => 'Tambacounda'],
            ['nom' => 'Goudiry', 'region' => 'Tambacounda'],
            ['nom' => 'Koumpentoum', 'region' => 'Tambacounda'],
            // Ziguinchor
            ['nom' => 'Ziguinchor', 'region' => 'Ziguinchor'],
            ['nom' => 'Bignona', 'region' => 'Ziguinchor'],
            ['nom' => 'Oussouye', 'region' => 'Ziguinchor'],
        ];

        foreach ($departementsData as $data) {
            $regionId = $regions[$data['region']] ?? null;
            if (!$regionId) {
                $this->command->warn("⚠️ Région non trouvée pour : " . $data['nom']);
                continue;
            }
            $slug = Str::slug($data['nom']);
            // Vérifier si le département existe déjà
            $existing = DB::table('departements')->where('slug', $slug)->first();
            if ($existing) {
                $departements[$data['nom']] = $existing->id;
            } else {
                $id = DB::table('departements')->insertGetId([
                    'nom' => $data['nom'],
                    'slug' => $slug,
                    'region_id' => $regionId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $departements[$data['nom']] = $id;
            }
        }
        $this->command->info('✅ ' . count($departements) . ' départements');

        // ============================================
        // 3. VILLES (avec vérification)
        // ============================================
        $this->command->info('📌 Villes...');

        $villesData = [
            'Dakar' => ['Dakar', 'Pikine', 'Guédiawaye', 'Rufisque', 'Yeumbeul', 'Thiaroye', 'Hann', 'Grand-Yoff', 'Médina', 'Plateau', 'Ouakam', 'Ngor', 'Yoff', 'Sicap Mermoz'],
            'Pikine' => ['Pikine', 'Thiaroye', 'Diamniadio', 'Mbao'],
            'Guédiawaye' => ['Guédiawaye', 'Wakhinane', 'Sam Notaire'],
            'Rufisque' => ['Rufisque', 'Bargny', 'Sendou', 'Sébikotane'],
            'Keur Massar' => ['Keur Massar', 'Malika', 'Yeumbeul Nord', 'Yeumbeul Sud'],
            'Thiès' => ['Thiès', 'Pout', 'Notto', 'Khombole', 'Kayar', 'Nguékhokh'],
            'Mbour' => ['Mbour', 'Saly', 'Popenguine', 'Nianing', 'Ngaparou', 'Somone', 'Joal-Fadiouth'],
            'Tivaouane' => ['Tivaouane', 'Mékhé', 'Darou Khoudoss', 'Mboro', 'Ndiassane'],
            'Saint-Louis' => ['Saint-Louis', 'Ndioum', 'Richard-Toll', 'Mpal', 'Gandiol'],
            'Dagana' => ['Dagana', 'Richard-Toll', 'Rosso', 'Ndombo'],
            'Podor' => ['Podor', 'Ndioum', 'Aéré', 'Mbal', 'Galoya'],
            'Diourbel' => ['Diourbel', 'Touba', 'Mbacké', 'Kael', 'Nguick', 'Taïf'],
            'Bambey' => ['Bambey', 'Dankh', 'Ndoulo', 'Pété'],
            'Mbacké' => ['Mbacké', 'Touba', 'Ndioumane', 'Taïf'],
            'Fatick' => ['Fatick', 'Diakhao', 'Sokone', 'Ndiop', 'Niodior'],
            'Foundiougne' => ['Foundiougne', 'Sokone', 'Niodior', 'Bassoul', 'Dionewar'],
            'Gossas' => ['Gossas', 'Pambal', 'Ndioum'],
            'Kaffrine' => ['Kaffrine', 'Ndoga Babacar', 'Gaye', 'Katahel'],
            'Birkelane' => ['Birkelane', 'Kahi', 'Mabo'],
            'Koungheul' => ['Koungheul', 'Lour Escale', 'Saloum'],
            'Malem-Hodar' => ['Malem-Hodar', 'Mabo', 'Ouol'],
            'Kaolack' => ['Kaolack', 'Kahone', 'Sibassor', 'Ndoffane', 'Gandiaye', 'Pakala'],
            'Nioro du Rip' => ['Nioro du Rip', 'Gandiaye'],
            'Guinguinéo' => ['Guinguinéo', 'Kahone', 'Mbadane'],
            'Kédougou' => ['Kédougou', 'Bandafassi', 'Dindéfello', 'Ségou'],
            'Salemata' => ['Salemata', 'Bandafassi'],
            'Saraya' => ['Saraya', 'Bembou', 'Khossanto'],
            'Kolda' => ['Kolda', 'Mampatim', 'Saré Yoba', 'Pata', 'Dabo'],
            'Vélingara' => ['Vélingara', 'Bounkiling', 'Goudomp', 'Saré Yoba'],
            'Médina Yoro Foulah' => ['Médina Yoro Foulah', 'Vélingara', 'Pata'],
            'Louga' => ['Louga', 'Kébémer', 'Sagatta', 'Ndiagne'],
            'Kébémer' => ['Kébémer', 'Linguère', 'Dahra'],
            'Linguère' => ['Linguère', 'Dahra', 'Ouadiour'],
            'Matam' => ['Matam', 'Ourossogui', 'Nabadji Civol', 'Sinthiou'],
            'Kanel' => ['Kanel', 'Diawara', 'Mbal'],
            'Ranérou' => ['Ranérou', 'Diawara', 'Kanel'],
            'Sédhiou' => ['Sédhiou', 'Djibabouya', 'Bounkiling', 'Goudomp'],
            'Bounkiling' => ['Bounkiling', 'Sédhiou', 'Goudomp', 'Pata'],
            'Goudomp' => ['Goudomp', 'Sédhiou', 'Bounkiling', 'Pata'],
            'Tambacounda' => ['Tambacounda', 'Koumpentoum', 'Bakel', 'Goudiry', 'Kidira', 'Koumel'],
            'Bakel' => ['Bakel', 'Kidira', 'Koumel', 'Béli'],
            'Goudiry' => ['Goudiry', 'Bakel', 'Koumpentoum', 'Kidira'],
            'Koumpentoum' => ['Koumpentoum', 'Tambacounda', 'Goudiry'],
            'Ziguinchor' => ['Ziguinchor', 'Bignona', 'Oussouye', 'Thionck-Essyl', 'Diouloulou'],
            'Bignona' => ['Bignona', 'Thionck-Essyl', 'Diouloulou', 'Oussouye'],
            'Oussouye' => ['Oussouye', 'Bignona', 'Ziguinchor', 'Diouloulou'],
        ];

        $villeCount = 0;
        foreach ($villesData as $departementNom => $villes) {
            $departementId = $departements[$departementNom] ?? null;
            if (!$departementId) {
                continue;
            }
            foreach ($villes as $villeNom) {
                $slug = Str::slug($villeNom);
                // Vérifier si la ville existe déjà
                $existing = DB::table('villes')->where('slug', $slug)->first();
                if (!$existing) {
                    DB::table('villes')->insert([
                        'nom' => $villeNom,
                        'slug' => $slug,
                        'departement_id' => $departementId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $villeCount++;
                }
            }
        }
        $this->command->info('✅ ' . $villeCount . ' nouvelles villes ajoutées');

        // ============================================
        // 4. UTILISATEURS (avec vérification)
        // ============================================
        $this->command->info('📌 Utilisateurs...');

        // Admin
        $adminEmail = 'admin@gestionstages.sn';
        if (!DB::table('users')->where('email', $adminEmail)->exists()) {
            DB::table('users')->insert([
                'name' => 'Admin Gestion Stages',
                'email' => $adminEmail,
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'telephone' => '771234567',
                'adresse' => 'Dakar, Sénégal',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Étudiant 1
        $etudiant1Email = 'baba@isi.sn';
        if (!DB::table('users')->where('email', $etudiant1Email)->exists()) {
            DB::table('users')->insert([
                'name' => 'Baba Niang',
                'email' => $etudiant1Email,
                'password' => Hash::make('password'),
                'role' => 'etudiant',
                'telephone' => '771234568',
                'adresse' => 'Dakar, Sénégal',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Étudiant 2
        $etudiant2Email = 'anta@isi.sn';
        if (!DB::table('users')->where('email', $etudiant2Email)->exists()) {
            DB::table('users')->insert([
                'name' => 'Anta Gueye',
                'email' => $etudiant2Email,
                'password' => Hash::make('password'),
                'role' => 'etudiant',
                'telephone' => '771234569',
                'adresse' => 'Dakar, Sénégal',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✅ Utilisateurs créés/vérifiés');

        // ============================================
        // 5. ENTREPRISES (avec vérification)
        // ============================================
        $this->command->info('📌 10 entreprises...');

        $villeIds = DB::table('villes')->pluck('id')->toArray();

        $entreprises = [
            ['nom' => 'Sonatel S.A', 'secteur_activite' => 'telecom', 'email' => 'contact@sonatel.sn', 'telephone' => '338391000', 'adresse' => 'Route des Almadies, Dakar', 'site_web' => 'https://www.sonatel.sn', 'taille' => '1000+', 'description' => 'Leader des télécommunications au Sénégal.'],
            ['nom' => 'Orange Sénégal', 'secteur_activite' => 'telecom', 'email' => 'contact@orange.sn', 'telephone' => '338390000', 'adresse' => 'Immeuble Orange, Dakar', 'site_web' => 'https://www.orange.sn', 'taille' => '1000+', 'description' => 'Opérateur mobile et internet de référence.'],
            ['nom' => 'Ecobank Sénégal', 'secteur_activite' => 'banque', 'email' => 'contact@ecobank.sn', 'telephone' => '338399000', 'adresse' => 'Place de l\'Indépendance, Dakar', 'site_web' => 'https://www.ecobank.com', 'taille' => '500+', 'description' => 'Banque panafricaine de premier plan.'],
            ['nom' => 'Sunu Assurances', 'secteur_activite' => 'banque', 'email' => 'contact@sunu.sn', 'telephone' => '338398000', 'adresse' => 'Rue Félix Faure, Dakar', 'site_web' => 'https://www.sunugroup.com', 'taille' => '500+', 'description' => 'Groupe d\'assurances leader en Afrique de l\'Ouest.'],
            ['nom' => 'TIGO Sénégal', 'secteur_activite' => 'telecom', 'email' => 'contact@tigo.sn', 'telephone' => '338397000', 'adresse' => 'Zone Aéroport, Dakar', 'site_web' => 'https://www.tigo.sn', 'taille' => '500+', 'description' => 'Opérateur de téléphonie mobile et services digitaux.'],
            ['nom' => 'Free Sénégal', 'secteur_activite' => 'telecom', 'email' => 'contact@free.sn', 'telephone' => '338396000', 'adresse' => 'Immeuble Free, Dakar', 'site_web' => 'https://www.free.sn', 'taille' => '200+', 'description' => 'Opérateur mobile et internet à bas prix.'],
            ['nom' => 'TotalEnergies Sénégal', 'secteur_activite' => 'industrie', 'email' => 'contact@total.sn', 'telephone' => '338395000', 'adresse' => 'Boulevard de la République, Dakar', 'site_web' => 'https://www.total.sn', 'taille' => '500+', 'description' => 'Groupe énergétique leader au Sénégal.'],
            ['nom' => 'Axa Sénégal', 'secteur_activite' => 'banque', 'email' => 'contact@axa.sn', 'telephone' => '338394000', 'adresse' => 'Rue Malenfant, Dakar', 'site_web' => 'https://www.axa.sn', 'taille' => '200+', 'description' => 'Groupe d\'assurances international.'],
            ['nom' => 'Nestlé Sénégal', 'secteur_activite' => 'commerce', 'email' => 'contact@nestle.sn', 'telephone' => '338393000', 'adresse' => 'Zone industrielle, Dakar', 'site_web' => 'https://www.nestle.sn', 'taille' => '200+', 'description' => 'Groupe agroalimentaire mondial.'],
            ['nom' => 'Coca-Cola Sénégal', 'secteur_activite' => 'commerce', 'email' => 'contact@cocacola.sn', 'telephone' => '338392000', 'adresse' => 'Zone industrielle, Dakar', 'site_web' => 'https://www.coca-cola.com', 'taille' => '100+', 'description' => 'Leader des boissons gazeuses au Sénégal.'],
        ];

        foreach ($entreprises as $data) {
            $email = $data['email'];
            if (!DB::table('entreprises')->where('email', $email)->exists()) {
                DB::table('entreprises')->insert([
                    'nom' => $data['nom'],
                    'slug' => Str::slug($data['nom']) . '-' . uniqid(),
                    'secteur_activite' => $data['secteur_activite'],
                    'email' => $email,
                    'telephone' => $data['telephone'],
                    'adresse' => $data['adresse'],
                    'site_web' => $data['site_web'],
                    'taille' => $data['taille'],
                    'description' => $data['description'],
                    'ville_id' => $villeIds[array_rand($villeIds)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        $this->command->info('✅ 10 entreprises vérifiées');

        // ============================================
        // 6. STAGES (avec vérification)
        // ============================================
        $this->command->info('📌 Stages...');

        $entrepriseIds = DB::table('entreprises')->pluck('id')->toArray();

        $stages = [
            ['titre' => 'Développeur Full Stack Laravel', 'type' => 'technique', 'duree' => '6 mois', 'remuneration' => 1, 'montant' => 150000, 'nb_postes' => 2],
            ['titre' => 'Assistant Marketing Digital', 'type' => 'professionnel', 'duree' => '4 mois', 'remuneration' => 1, 'montant' => 120000, 'nb_postes' => 1],
            ['titre' => 'Analyste Financier Junior', 'type' => 'recherche', 'duree' => '3 mois', 'remuneration' => 0, 'montant' => null, 'nb_postes' => 2],
            ['titre' => 'Ingénieur Réseaux et Télécoms', 'type' => 'technique', 'duree' => '5 mois', 'remuneration' => 1, 'montant' => 180000, 'nb_postes' => 3],
            ['titre' => 'Assistant RH', 'type' => 'professionnel', 'duree' => '4 mois', 'remuneration' => 0, 'montant' => null, 'nb_postes' => 1],
            ['titre' => 'Développeur Mobile Flutter', 'type' => 'technique', 'duree' => '6 mois', 'remuneration' => 1, 'montant' => 160000, 'nb_postes' => 2],
            ['titre' => 'Chargé de Communication', 'type' => 'professionnel', 'duree' => '3 mois', 'remuneration' => 0, 'montant' => null, 'nb_postes' => 1],
            ['titre' => 'Ingénieur Cybersécurité', 'type' => 'recherche', 'duree' => '6 mois', 'remuneration' => 1, 'montant' => 200000, 'nb_postes' => 2],
        ];

        foreach ($stages as $data) {
            $titre = $data['titre'];
            $slug = Str::slug($titre) . '-' . uniqid();
            if (!DB::table('stages')->where('titre', $titre)->exists()) {
                DB::table('stages')->insert([
                    'titre' => $titre,
                    'slug' => $slug,
                    'description' => 'Stage de ' . $data['duree'] . ' pour ' . $titre . '. Une excellente opportunité pour développer vos compétences.',
                    'entreprise_id' => $entrepriseIds[array_rand($entrepriseIds)],
                    'ville_id' => $villeIds[array_rand($villeIds)],
                    'duree' => $data['duree'],
                    'date_debut' => now()->addDays(rand(10, 30)),
                    'date_fin' => now()->addDays(rand(100, 200)),
                    'date_limite_candidature' => now()->addDays(rand(5, 20)),
                    'type' => $data['type'],
                    'statut' => ['ouvert', 'en_cours', 'ferme'][rand(0, 2)],
                    'remuneration' => $data['remuneration'],
                    'montant_remuneration' => $data['montant'],
                    'nb_postes' => $data['nb_postes'],
                    'competences_requises' => 'PHP, Laravel, MySQL, Git, travail en équipe',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        $this->command->info('✅ ' . count($stages) . ' stages vérifiés');

        $this->command->info('🎉 Seeding terminé avec succès !');
    }
}