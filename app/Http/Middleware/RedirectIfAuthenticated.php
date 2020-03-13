<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
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
        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }
        //public function redirectTo()
    //{
        // User role
       /* $role =  Auth::user()->roles()->pluck('name');

        // Check user role
       switch ($role) {
            case 'SuperAdmin':
                return '/list';
                break;
            case 'admin_ESTM':
                return '/list_estm';
                break;
            default:
                return '/login';
                break;
       // }
    }*/

        return $next($request);
    }
}
