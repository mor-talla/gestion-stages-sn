<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    // Rediriger vers Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Callback Google
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            return $this->loginOrRegister($user, 'google');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Échec de l\'authentification Google.');
        }
    }

    // Rediriger vers GitHub
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    // Callback GitHub
    public function handleGithubCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
            return $this->loginOrRegister($user, 'github');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Échec de l\'authentification GitHub.');
        }
    }

    // Méthode commune pour login ou register
    protected function loginOrRegister($socialUser, $provider)
    {
        // Vérifier si l'utilisateur existe déjà par email
        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            // Mettre à jour le provider_id si vide
            if (empty($user->provider_id)) {
                $user->provider_id = $socialUser->getId();
                $user->provider = $provider;
                $user->save();
            }
            Auth::login($user);
            return redirect()->intended('/dashboard');
        }

        // Créer un nouvel utilisateur
        $newUser = User::create([
            'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'Utilisateur',
            'email' => $socialUser->getEmail(),
            'password' => Hash::make(Str::random(24)),
            'provider_id' => $socialUser->getId(),
            'provider' => $provider,
            'role' => 'etudiant', // Par défaut
            'telephone' => null,
            'adresse' => null,
        ]);

        Auth::login($newUser);
        return redirect()->intended('/dashboard');
    }
}