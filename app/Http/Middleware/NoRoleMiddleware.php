<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  \Closure
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->roles->isEmpty()) {
            return $next($request);
        }

        return redirect('/dashboard'); // Redirigez vers la page d'accueil ou une autre page si l'utilisateur a un rôle
    }
}
