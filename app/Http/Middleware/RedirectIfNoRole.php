<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RedirectIfNoRole
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        
        if ($user->hasRole('eleve')) {
            return redirect()->route('eleve.dashboard');
        } elseif ($user->hasRole('moniteur')) {
            return redirect()->route('moniteur.dashboard');
        } elseif ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('superadmin')) {
            return redirect()->route('superadmin.dashboard');
        } elseif (!$user->roles->count()) {
            return redirect()->route('no_role');
        }

        return $next($request);
    }
}
