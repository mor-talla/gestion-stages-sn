<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Gestion Stages',
            'email' => 'admin@gestionstages.sn',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'telephone' => '773456789',
            'adresse' => 'Dakar, Sénégal',
        ]);
    }
}