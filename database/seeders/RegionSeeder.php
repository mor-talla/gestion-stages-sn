<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region; // Assure-toi d'avoir ce modèle
use Illuminate\Support\Str;

class RegionSeeder extends Seeder
{
    public function run()
    {
        $regions = [
            'Dakar', 'Ziguinchor', 'Diourbel', 'Saint-Louis', 'Tambacounda',
            'Kaolack', 'Thiès', 'Louga', 'Fatick', 'Kolda', 'Matam',
            'Kaffrine', 'Kédougou', 'Sédhiou'
        ];

        foreach ($regions as $region) {
            Region::create([
                'nom' => $region,
                'slug' => Str::slug($region),
            ]);
        }
    }
}