<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Afficher le formulaire d'inscription.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Traiter l'inscription.
     */
 public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'role' => ['required', 'in:etudiant'], // 🔥 Seul "etudiant" est autorisé
        'telephone' => ['required', 'string', 'max:20'],
    ]);

    // Forcer le rôle à "etudiant" (sécurité supplémentaire)
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'etudiant', // 🔥 Toujours étudiant
        'telephone' => $request->telephone,
        'adresse' => null,
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect()->route('dashboard')->with('success', 'Bienvenue sur Gestion Stages SN !');
}

     
}


