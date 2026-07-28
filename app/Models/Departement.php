<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $fillable = ['nom', 'slug', 'region_id'];
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function villes()
    {
        return $this->hasMany(Ville::class);
    }
}