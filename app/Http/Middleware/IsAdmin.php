<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
   public function handle($request, Closure $next)
{
    $user = auth()->user();
    dd($user);  // Tu verras les données de l'utilisateur connecté

    if (!$user || $user->isadmin != 1) {
        abort(403, 'Accès refusé');
    }

    return $next($request);
}

}


