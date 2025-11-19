<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class BlogController extends Controller
{
    public function index() {
        $blogs = Blog::where('status', 'published')->get();

        return view('blogs.index', ['blogs' => $blogs]);
    }

    public function show(int $id) {
        $blog = Blog::with('categories')->where('id', $id)->get()->first();

        return view('blogs.show', [
            'blog' => $blog
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
        $data = $request->validate([
            'title' => 'required',
            'desc' => 'required',
        ]);

        $blog = new Blog();
        $blog->title = $data['title'];
        $blog->desc = $data['desc'];
        $blog->author_id = auth()->user()->id;
        $blog->save();

        return to_route('dashboard.blogs.edit', ['id' => $blog->id]);
    }

    public function edit(int $id) {
        $blog = Blog::with('categories')->where('id', $id)->get()->first();
        $categories = Category::all();

        if ($blog->status === 'published') {
            // TODO: tell the user why this page is not accesible
            return to_route('dashboard.blogs');
        }

        return view('dashboard.blogs-edit', ['blog' => $blog, 'categories' => $categories]);
    }

    public function update(Request $request, int $id) {
        Log::debug('[BlogController::update()] Method is being executed.');
        $blog = Blog::findOrFail($id);

        $data = $request->only(['title', 'body', 'desc', 'cover', 'cover_alt', 'categories']);

        Log::debug('[BlogController::update()] Do we have a cover here???');
        $oldCover = null;
        if ($request->hasFile('cover')) {
            Log::debug('[BlogController::update()] There is a new cover!');

            // TODO: Combine resize with resizeCanvas to avoid stretch images
            $upload = $request->file('cover');
            $image = Image::read($upload)->resize(300, 158);
            $path = 'covers/' . Str::random() . '.' . $upload->getClientOriginalExtension();
            Storage::put(
              $path,
              $image->encodeByExtension($upload->getClientOriginalExtension(), quantity: 70)
            );

            $data['cover'] = $path;

            $oldCover = $blog->cover;
        } else {
            $data['cover'] = $blog->cover;
        }

        if($oldCover !== null && \Storage::exists($oldCover)) {
            Log::debug('[BlogController::update()] Deleting old cover and replacing existing cover');
            Storage::delete($oldCover);
        }

        Log::info('[BlogController::update()] Data:', ['data' => $data]);

        $blog->body = $data['body'];
        $blog->title = $data['title'];
        $blog->desc = $data['desc'];
        $blog->cover = $data['cover'];
        $blog->cover_alt = $data['cover_alt'];
        $blog->save();

        $blog->categories()->sync($request->input('categories', []));
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
        $blog->status = 'published';
        $blog->verifier_id = auth()->user()->id;
        $blog->save();

        return to_route('dashboard.blogs');
    }

    public function publish_requests() {
        $requests = Blog::where('status', 'validating')->get();

        return view('dashboard.blogs-requests', ['requests' => $requests]);
    }

    public function handle_publish_request_result(Blog $blog, Request $request) {
        Log::debug('[BlogController handle_publish_request_result()] Method is being executed');
        $data = $request->only(['result', 'message']);

        // TODO: Validations? (send a message if the result is deny for example)

        // Deny / Allow
        if($data['result'] === 'deny') {
            $blog->status = 'draft';
            $blog->save();
        } else if ($data['result'] === 'allow' && $blog->status === 'validating') {
            // If the user has moved the blog to 'draft' while it was being validating,
            // I don't want to publish it (that is why I made the 2nd validation)
            $blog->status = 'published';
            $blog->verifier_id = auth()->user()->id;
            $blog->save();
        }

        // TODO: Notifications / Feedback

        // Return
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

    public function like(int $id) {
        $blog = Blog::findOrFail($id);

        return to_route('blogs.show', ['id' => $id]);
    }
}
