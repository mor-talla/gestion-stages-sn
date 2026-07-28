<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'telephone',
    'adresse',
    'entreprise_id',
    'provider',
    'provider_id',
];

    protected $hidden = [
        'password',
        'remember_token',
    ];



    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isEntreprise()
    {
        return $this->role === 'entreprise';
    }

    public function isEtudiant()
    {
        return $this->role === 'etudiant';
    }
}