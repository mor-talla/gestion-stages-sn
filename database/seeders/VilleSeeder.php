<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VilleSeeder extends Seeder
{
    public function run()
    {
        // Désactiver les contraintes de clé étrangère
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Supprimer toutes les villes existantes
        DB::table('villes')->truncate();
        
        // Réactiver les contraintes
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Récupérer les ID des départements
        $departements = DB::table('departements')->pluck('id', 'nom')->toArray();

        // Liste des villes par département
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

        foreach ($villesData as $departementNom => $villes) {
            $departementId = $departements[$departementNom] ?? null;
            if (!$departementId) {
                continue;
            }
            foreach ($villes as $villeNom) {
                DB::table('villes')->insert([
                    'nom' => $villeNom,
                    'slug' => Str::slug($villeNom),
                    'departement_id' => $departementId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('✅ ' . DB::table('villes')->count() . ' villes insérées.');
    }
}