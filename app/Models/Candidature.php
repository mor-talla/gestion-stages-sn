<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $fillable = [
        'stage_id', 'user_id', 'nom_candidat', 'prenom', 'email', 
        'telephone', 'cv_path', 'lettre_motivation', 'statut', 'date_candidature'
    ];
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}