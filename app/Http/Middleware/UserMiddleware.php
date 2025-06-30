<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (Auth::check()) {
            if ($user->userrole == 'owner') {
                return $next($request);
            } else {
                return redirect()->route('admin.dashboard');
            }
        } else {

            return redirect()->route('f.login');
        }
    }
}
