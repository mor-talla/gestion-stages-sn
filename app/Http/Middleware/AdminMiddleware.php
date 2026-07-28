<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Vérifier si l'utilisateur est admin
        if (Auth::user()->role !== 'admin') {
            // Rediriger vers le dashboard (pour éviter une boucle)
            return redirect()->route('dashboard')
                ->with('error', 'Accès réservé aux administrateurs.');
        }

        return $next($request);
    }
}