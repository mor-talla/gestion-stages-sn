<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $fillable = [
        'titre', 'slug', 'description', 'entreprise_id', 'ville_id',
        'adresse_exacte', 'duree', 'remuneration', 'montant_remuneration',
        'date_debut', 'date_fin', 'type', 'statut', 'competences_requises',
        'nb_postes', 'date_limite_candidature'
    ];
protected $dates = [
    'date_debut',
    'date_fin',
    'date_limite_candidature',
];


     
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
   public function candidatures()
{
    return $this->hasMany(Candidature::class);
}
}