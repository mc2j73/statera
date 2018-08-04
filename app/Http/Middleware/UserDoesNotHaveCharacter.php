<?php

namespace App\Http\Middleware;

use Closure;

class UserDoesNotHaveCharacter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!\Auth::user()->character()->exists()) {
            return redirect()->route('character.create');
        }

        return $next($request);
    }
}
