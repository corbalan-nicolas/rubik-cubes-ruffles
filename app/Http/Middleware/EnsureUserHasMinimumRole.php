<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasMinimumRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int $minRole): Response
    {
        // This is not necessary because I should have the auth middleware as well, but just in case...
        if (!auth()->check()) {
            Session::flash('toast.message', 'You must be logged in to access this page.');
            Session::flash('toast.type', 'warning');

            return to_route('auth.login.show');
        }

        Log::info('Min role', ['allowed' => auth()->user()->role_id < $minRole]);
        if (auth()->user()->role_id < $minRole) {
            Session::flash('toast.message', 'Your role is not enough to access this page.');
            Session::flash('toast.type', 'info');

            return to_route('dashboard.index');
        }

        return $next($request);
    }
}
