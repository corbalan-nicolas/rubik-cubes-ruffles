<?php

namespace App\Http\Middleware;

use App\Models\Blog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsBlogOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('--------------------------------------------------------------------------------------------------');
        Log::info('[EnsureIsBlogOwner] Middleware');

        $blog = $request->route('blog') ?? null;
        $id = $request->route('id');

        Log::info('ID: '. $id);
        Log::info('Should I just let him pass?: ' . $id == 0 ? 'Yes' : 'No');

        if ($id == 0) {
            return $next($request);
        }

        $blog = Blog::findOrFail($id);

        if ($blog->author_id !== auth()->user()->id) {
            Session::flash('toast.message', "You cannot proceed because that blog it's not yours");
            Session::flash('toast.type', 'danger');

            return to_route('dashboard.blogs');
        }

        return $next($request);
    }
}
