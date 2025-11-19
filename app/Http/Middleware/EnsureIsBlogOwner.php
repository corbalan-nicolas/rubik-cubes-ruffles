<?php

namespace App\Http\Middleware;

use App\Models\Blog;
use Closure;
use Illuminate\Http\Request;
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
        $blog = $request->route('blog') ?? null;
        $id = $request->route('id') ?? null;

        if ($id !== null) {
            $blog = Blog::findOrFail($id);
        }

        if ($blog->author_id !== auth()->user()->id) {
            Session::flash('toast.message', "You cannot proceed because that blog it's not yours");
            Session::flash('toast.type', 'danger');

            return to_route('dashboard.blogs');
        }

        return $next($request);
    }
}
