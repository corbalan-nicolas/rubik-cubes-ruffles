<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index() {
        $blogs = Blog::where('status', 'published')->get();

        return view('blogs.index', ['blogs' => $blogs]);
    }

    public function show(int $id) {
        $blog = Blog::findOrFail($id);
        $html_body = Str::of($blog->body)->markdown([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
            'max_nesting_level' => 10, // 10 - 50
            'max_delimiters_per_line' => 100 // 100 - 1_000
        ]);

        return view('blogs.show', [
            'blog' => $blog,
            'html_body' => $html_body,
        ]);
    }

    public function admin_my_blogs() {
        $author_id = auth()->user()->id;

        $blogsDraft = Blog::where('author_id', $author_id)->where('status', 'draft')->orderBy('updated_at', 'desc')->get();
        $blogsPublished = Blog::where('author_id', $author_id)->where('status', 'published')->get();
        $blogsValidating = Blog::where('author_id', $author_id)->where('status', 'validating')->get();

        $hasBlogs = (count($blogsDraft) + count($blogsPublished) + count($blogsValidating)) > 0;

        return view('dashboard.blogs', [
            'blogsDraft' => $blogsDraft,
            'blogsPublished' => $blogsPublished,
            'blogsValidating' => $blogsValidating,
            'hasBlogs' => $hasBlogs,
        ]);
    }

    public function store(Request $request) {
        // It's not allowed to create a blog
        if(auth()->user()->role->id < 2) {
            return view('dashboard.index');
        }

        $data = $request->validate([
            'title' => 'required',
            'desc' => 'required',
        ]);

        // COVER FIELD
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers');
            // Use "storeAs($route, $name)" to set the name
        }

        $blog = new Blog();
        $blog->title = $data['title'];
        $blog->desc = $data['desc'];
        $blog->author_id = auth()->user()->id;
        $blog->cover = $data['cover'] ?? null;
        $blog->save();

        return to_route('dashboard.blogs.edit', ['id' => $blog->id]);
    }

    public function edit(int $id) {
        $blog = Blog::findOrFail($id);

        if ($blog->status === 'published') {
            // TODO: tell the user why this page is not accesible
            return to_route('dashboard.blogs');
        }

        return view('dashboard.blogs-edit', ['blog' => $blog]);
    }

    public function update(Request $request, int $id) {
        Log::debug('[BlogController::update()] Method is being executed.');
        $blog = Blog::findOrFail($id);

        $data = $request->only(['title', 'body', 'desc', 'cover', 'cover_alt']);

        Log::debug('[BlogController::update()] Do we have a cover here???');
        $oldCover = null;
        if ($request->hasFile('cover')) {
            Log::debug('[BlogController::update()] There is a new cover!');
            $data['cover'] = $request->file('cover')->store('covers');
            $oldCover = $blog->cover;
        } else {
            $data['cover'] = $blog->cover;
        }

        if($oldCover !== null && \Storage::exists($oldCover)) {
            Log::debug('[BlogController::update()] Deleting old cover and replacing existing cover');
            \Storage::delete($oldCover);
        }

        $blog->body = $data['body'];
        $blog->title = $data['title'];
        $blog->desc = $data['desc'];
        $blog->cover = $data['cover'];
        $blog->cover_alt = $data['cover_alt'];
        $blog->save();

        Log::debug('[BlogController::update()] All good here :), returning response');
        return response()->json(['data' => [
            'cover' => $blog->cover,
            'cover_alt' => $blog->cover_alt
        ]]);
    }

    public function request_publish(Request $request, Blog $blog) {
        // TODO Validate inputs, role with middleware, and show feedback
        Log::debug('Validating');
        $blog->status = 'validating';
        $blog->save();

        return to_route('dashboard.blogs');
    }

    public function publish(Request $request, Blog $blog) {
        // TODO: Validate inputs, role with middleware, and show feedback
        $blog->status = 'published';
        $blog->verifier_id = auth()->user()->id;
        $blog->save();

        return to_route('dashboard.blogs');
    }

    public function publish_requests() {
        $requests = Blog::where('status', 'validating')->get();

        return view('dashboard.blogs-requests', ['requests' => $requests]);
    }

    public function deny_publish(Blog $blog) {
        $blog->status = 'draft';
        $blog->save();

        return to_route('dashboard.blogs.publish_requests');
    }

    public function allow_publish(Blog $blog) {
        // If the blogger / company cancels the validation, I don't want it to be published
        if ($blog->status === 'validating') {
            $blog->status = 'published';
            $blog->verifier_id = auth()->user()->id;
            $blog->save();
        }

        return to_route('dashboard.blogs.publish_requests');
    }

    public function destroy(Blog $blog) {
        $blog->delete();

        return to_route('dashboard.blogs');
    }

    public function move_to_draft(Blog $blog) {
        $blog->status = 'draft';
        $blog->save();

        return to_route('dashboard.blogs');
    }
}
