<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    protected $fillable = [
        'nom', 'slug', 'adresse', 'ville_id', 'telephone', 'email', 
        'site_web', 'logo', 'description', 'secteur_activite', 'taille'
    ];
    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}