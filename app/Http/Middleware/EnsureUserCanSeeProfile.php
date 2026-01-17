<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserCanSeeProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isNotAuthUserProfile = $request->route()->parameter('id') != auth()->user()->id;
        $hasNotMinimumRole = auth()->user()->role_id < 4;

        if ($isNotAuthUserProfile && $hasNotMinimumRole) {
            Session::flash('toast.message', 'You are not allowed to see this profile');
            Session::flash('toast.type', 'warning');

            return to_route('dashboard.index');
        }

        return $next($request);
    }
}
