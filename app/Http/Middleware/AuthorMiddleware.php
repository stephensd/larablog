<?php

namespace App\Http\Middleware;

use Closure;

class AuthorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
          $user = $request->user();
          if (isset($user) && ($user->role_id === 1 || $user->role_id === 2)) {
            return $next($request);
          }
          return redirect('/');
    }
}
