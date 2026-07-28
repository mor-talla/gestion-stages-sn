<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['nom', 'slug', 'description', 'image'];
    public function departements()
    {
        return $this->hasMany(Departement::class);
    }
}