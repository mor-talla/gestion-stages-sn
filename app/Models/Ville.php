<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $fillable = ['nom', 'slug', 'departement_id'];
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }
    public function entreprises()
    {
        return $this->hasMany(Entreprise::class);
    }
}