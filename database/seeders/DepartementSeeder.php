<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departement;
use App\Models\Region;
use Illuminate\Support\Str;

class DepartementSeeder extends Seeder
{
    public function run()
    {
        // Récupère les ID des régions
        $regions = Region::all()->keyBy('nom');

        $departements = [
            // Dakar
            ['nom' => 'Dakar', 'region' => 'Dakar'],
            ['nom' => 'Pikine', 'region' => 'Dakar'],
            ['nom' => 'Rufisque', 'region' => 'Dakar'],
            ['nom' => 'Guédiawaye', 'region' => 'Dakar'],
            ['nom' => 'Keur Massar', 'region' => 'Dakar'],
            // Ziguinchor
            ['nom' => 'Bignona', 'region' => 'Ziguinchor'],
            ['nom' => 'Oussouye', 'region' => 'Ziguinchor'],
            ['nom' => 'Ziguinchor', 'region' => 'Ziguinchor'],
            // Diourbel
            ['nom' => 'Bambey', 'region' => 'Diourbel'],
            ['nom' => 'Diourbel', 'region' => 'Diourbel'],
            ['nom' => 'Mbacké', 'region' => 'Diourbel'],
            // Saint-Louis
            ['nom' => 'Dagana', 'region' => 'Saint-Louis'],
            ['nom' => 'Podor', 'region' => 'Saint-Louis'],
            ['nom' => 'Saint-Louis', 'region' => 'Saint-Louis'],
            // Tambacounda
            ['nom' => 'Bakel', 'region' => 'Tambacounda'],
            ['nom' => 'Tambacounda', 'region' => 'Tambacounda'],
            ['nom' => 'Goudiry', 'region' => 'Tambacounda'],
            ['nom' => 'Koumpentoum', 'region' => 'Tambacounda'],
            // Kaolack
            ['nom' => 'Kaolack', 'region' => 'Kaolack'],
            ['nom' => 'Nioro du Rip', 'region' => 'Kaolack'],
            ['nom' => 'Guinguinéo', 'region' => 'Kaolack'],
            // Thiès
            ['nom' => 'M\'bour', 'region' => 'Thiès'],
            ['nom' => 'Thiès', 'region' => 'Thiès'],
            ['nom' => 'Tivaouane', 'region' => 'Thiès'],
            // Louga
            ['nom' => 'Kébémer', 'region' => 'Louga'],
            ['nom' => 'Linguère', 'region' => 'Louga'],
            ['nom' => 'Louga', 'region' => 'Louga'],
            // Fatick
            ['nom' => 'Fatick', 'region' => 'Fatick'],
            ['nom' => 'Foundiougne', 'region' => 'Fatick'],
            ['nom' => 'Gossas', 'region' => 'Fatick'],
            // Kolda
            ['nom' => 'Kolda', 'region' => 'Kolda'],
            ['nom' => 'Vélingara', 'region' => 'Kolda'],
            ['nom' => 'Médina Yoro Foulah', 'region' => 'Kolda'],
            // Matam
            ['nom' => 'Kanel', 'region' => 'Matam'],
            ['nom' => 'Matam', 'region' => 'Matam'],
            ['nom' => 'Ranérou', 'region' => 'Matam'],
            // Kaffrine
            ['nom' => 'Kaffrine', 'region' => 'Kaffrine'],
            ['nom' => 'Birkelane', 'region' => 'Kaffrine'],
            ['nom' => 'Koungheul', 'region' => 'Kaffrine'],
            ['nom' => 'Malem-Hodar', 'region' => 'Kaffrine'],
            // Kédougou
            ['nom' => 'Kédougou', 'region' => 'Kédougou'],
            ['nom' => 'Salemata', 'region' => 'Kédougou'],
            ['nom' => 'Saraya', 'region' => 'Kédougou'],
            // Sédhiou
            ['nom' => 'Sédhiou', 'region' => 'Sédhiou'],
            ['nom' => 'Bounkiling', 'region' => 'Sédhiou'],
            ['nom' => 'Goudomp', 'region' => 'Sédhiou'],
        ];

        foreach ($departements as $data) {
            Departement::create([
                'nom' => $data['nom'],
                'slug' => Str::slug($data['nom']),
                'region_id' => $regions[$data['region']]->id,
            ]);
        }
    }
}