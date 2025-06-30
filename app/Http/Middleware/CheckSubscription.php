<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Check if the user has an active subscription
        if (!$user->subscription_plan_id || !$user->subscriptionPlan->isValid()) {
            return redirect()->route('subscriptions.index')->with('error', 'You need an active subscription to post ads.');
        }

        return $next($request);
    }
}
