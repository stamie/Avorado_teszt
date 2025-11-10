<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Kezeli a bejövő kérést.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Ellenőrizzük, hogy a felhasználó be van-e jelentkezve.
        if (! Auth::check()) {
            return redirect('/login'); // Átirányítás bejelentkezésre, ha nincs Auth
        }

        // 2. Ellenőrizzük a szerepkört.
        $user = Auth::user();
        var_dump($user);
        // Feltételezve, hogy a User modellben van egy hasRole() metódus (lásd fent)
        if (! $user->hasRole($role)) {
            // Ha a felhasználó nem rendelkezik a szükséges szerepkörrel, 403-as hibát dobunk.
            abort(403, 'Nincs jogosultsága ehhez a művelethez.'); 
        }

        return $next($request);
    }
}