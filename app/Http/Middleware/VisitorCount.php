<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class VisitorCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();

        if (!Cache::has("visitor_{$ip}")) {
            Cache::put("visitor_{$ip}", true, now()->addHours(1)); // Store for 1 hour

            // Use DB transaction to prevent race conditions
            DB::table('visitors')->updateOrInsert([], [
                'count' => DB::raw('count + 1')
            ]);
        }
        return $next($request);
    }
}
